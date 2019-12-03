<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<div class, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="register.css">
    <title>Document</title>
</head>
<body>

<?php
require('config.php');
// If the values are posted, insert them into the database.
if (isset($_POST['submit'])){
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo "$password ddd";
    $cpassword = $_POST['confirmpassword'];
    $slquery = "SELECT 1 FROM registration WHERE email = '$email'";
    $selectresult = mysqli_query($conn,$slquery);
    if(mysqli_num_rows($selectresult)>0)
    {
         $msg = 'email already exists';
    }
    elseif($password != $cpassword){
         $msg = "passwords doesn't match";
    }
    else{

        
          $hashpassword=password_hash($password,PASSWORD_DEFAULT);
          $query = "INSERT INTO `registration` (fname,lname,email,password) VALUES ('$firstname','$lastname','$email','$hashpassword')";
          $result = mysqli_query($conn,$query);
          if($result){
             $msg = "User Created Successfully.";
          }
    }
   }
  
?>

    <div class="simple-form">
        
      <form action="" id="registration" method="POST">
            <h2 class="text">Registration Form</h2>
      <input type="text" name="firstname" id="button" placeholder="Firstname"><br><br>
      <input type="text" name="lastname" id="button" placeholder="Lastname"><br><br>
      <input type="email" name="email" id="button" placeholder="Email"><br><br>
      <input type="Password" name="password" id="button" placeholder="Password"><br><br>
      <input type="Password" name="confirmpassword" id="button" placeholder="Confirm Password"><br><br>
      <input type="submit" value="Register" id="submit" name="submit">

      </form>
</body>
</html>