<?php
session_start();
require_once("functions.php");
$conn=connectionDB();
$status=$_POST['status'];
$userid=$_POST['userid'];

foreach($userid as $key => $value)
{
    $stmt = $conn->prepare("UPDATE registration SET status=? WHERE uid=?");
    $stmt->bind_param("si", $status, $value );
    $stmt->execute();
}

    $user_reg_details_query="SELECT * from registration";
    $user_reg_details_results=$conn->query($user_reg_details_query);
    
    if($user_reg_details_results->num_rows > 0) {
        while($user_reg_details_row = $user_reg_details_results->fetch_assoc()) {
    
            if($user_reg_details_row['role'] != "admin")
            {
                $uid=$user_reg_details_row['uid'];
                echo "<tr> 
                    <td>   <input type='checkbox' class='selectuser' name='selectuser[]' value='$uid'> </td>
                    <td>".$user_reg_details_row['fname']." ".$user_reg_details_row['lname']."</td>
                    <td>".$user_reg_details_row['email']."</td>
                    <td>".$user_reg_details_row['role']."</td>
                    <td>".$user_reg_details_row['status']."</td>
                    </tr>";
            }
        }
      }


?>