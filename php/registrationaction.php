<?php
require_once('functions.php');

if (isset($_POST['submit'])){
  $conn = connectionDB();
  $firstname = cleantext($_POST['firstname']);
  $lastname = cleantext($_POST['lastname']);
  $email = cleantext($_POST['email']);
  $password = cleantext($_POST['password']);
  $cpassword = cleantext($_POST['confirmpassword']);
  register($conn, $firstname, $lastname, $email,$password,$cpassword);
}
?>
