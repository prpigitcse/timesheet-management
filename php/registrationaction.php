<?php
require_once('functions.php');
  $conn = connectionDB();
  $firstname = cleantext($_POST['firstname']);
  $lastname = cleantext($_POST['lastname']);
  $email = cleantext($_POST['email']);
  $password = cleantext($_POST['password']);
  $cpassword = cleantext($_POST['confirmpassword']);
  $role=cleantext($_POST['role']);
  $agree=$_POST['agree'];
  $status='pending';

  if($firstname==""||$email==""||$password==""){
    $Message = "Firstname or password or email is empty";
    header("Location:../registration.php?error={$Message}");
  }
  else{
  register($conn, $firstname, $lastname, $email,$password,$cpassword,$role,$status);
  }


?>
