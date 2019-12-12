<?php
session_start();
require_once "functions.php";
$conn=connectionDb();
$status=$_POST['status'];
$userId=$_POST['userId'];

foreach ($userId as $key => $value) {
    updateRegStatus($status, $value, $conn);
}

$userRegDetailsResults=selectAllReg($conn, $filter="all");

if ($userRegDetailsResults->num_rows > 0) {
    while ($userRegDetailsRow = $userRegDetailsResults->fetch_assoc()) {
        if ($userRegDetailsRow['role'] != "admin") {
            $uid=$userRegDetailsRow['uid'];
            echo "<tr>
                    <td>   <input type='checkbox' class='selectUser' name='selectUser[]' value='$uid'> </td>
                    <td>".$userRegDetailsRow['fname']." ".$userRegDetailsRow['lname']."</td>
                    <td>".$userRegDetailsRow['email']."</td>
                    <td>".$userRegDetailsRow['role']."</td>
                    <td>".$userRegDetailsRow['status']."</td>
                    </tr>";
        }
    }
}
