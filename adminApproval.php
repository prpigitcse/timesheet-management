<?php
   
session_start();
require_once("php/functions.php");

if(!isset($_SESSION["user"]))
        header("Location: index.php");


$conn=connectionDB();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="text-center py-2">
            <h2>Registered Users</h2>
        </div>

        <div class="text-center">
            <p style="color:green;text-align:center" id="message"></p>
        </div>
        <div class="row py-2">

            <div class="col-6">
                <select id="action" name="action" class="form-control">
                    <option value="none" selected disabled hidden>Select Action </option> 
                    <option value="approved">Approve</option>
                    <option value="rejected">Reject</option>
                </select>
            </div>
            <div class="col-6">
                <select id="status" name="status" class="form-control">
                    <option value="none" selected disabled hidden> Filter </option> 
                    <option value="all">All users</option>
                    <option value="approved">Approved users</option>
                    <option value="pending">Pending users</option>
                    <option value="rejected">Rejected users</option>
                </select>            
            </div>
        
            </div>

        <div class="row py-2">
        <table class="table table-responsive-sm">
  <thead>
    <tr class="thead-light">
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody id="response">

<?php

  //fetch values from registration table for all user
  $user_reg_details_results=selectAllUsers($conn);

  if($user_reg_details_results->num_rows > 0) {
    while($user_reg_details_row = $user_reg_details_results->fetch_assoc()) {

        if($user_reg_details_row['role'] != "admin")
        {
            $uid=$user_reg_details_row['uid'];
            echo "<tr>";
            echo "<td>  <input type='checkbox' class='selectuser' name='selectuser[]' value='.$uid.'></td>";
            echo "<td>".$user_reg_details_row['fname']." ".$user_reg_details_row['lname']."</td>";
            echo "<td>".$user_reg_details_row['email']."</td>";
            echo "<td>".$user_reg_details_row['role']."</td>";
            echo "<td>".$user_reg_details_row['status']."</td>";
            echo "</tr>";
        }
    }
  }
?>
    
  </tbody>
</table>
        
        
        </div>

        <div class="row py-2">
            <div class="col-6">
                <input id="submitaction" class="btn btn-primary" type="submit" name="submitaction" value="Action">
            </div>

        </div>
    
    
    
    </div>
 

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#status").change(function(e) {
                    // var val = $('#status option:selected').val();
                    var val = $(this).val();
                    e.preventDefault();
                    $.ajax({
                    url: 'php/filterUsers.php',
                    type: 'post',
                    data: {
                        status: val
                    },
                    success: function(response) {     
                        $("#response").html(response);
                    }

                });
            });


            $("#submitaction").click(function(e) {
                e.preventDefault();
                var val = $('#action option:selected').val();
                if(val=='none')
                {
                    alert("Select an action");

                }   else {
                        if($(".selectuser:checked").length > 0) {
                            var selecteduserid = [];
                            $('.selectuser').each(function() {
                                if ($(this).is(":checked")) {
                                    selecteduserid.push($(this).val());
                                }
                            });

                            $.ajax({
                                url: 'php/userStatusUpdate.php',
                                type: 'post',
                                data: {
                                    status: val,
                                    userid : selecteduserid
                                },
                                success: function(response) {    
                                    $("#response").html(response);
                                    $("#message").text('Status Updated');

                                }
                            });
                        }   else{
                                alert("Select users");
                            }
                    }
            });
        });
    </script>
      
</body>
</html>
