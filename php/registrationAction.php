<?php
require_once('functions.php');
  $conn = connectionDb();
  $firstName = cleanText($_POST['firstName']);
  $lastName = cleanText($_POST['lastName']);
  $email = cleanText($_POST['email']);
  $newPassword = cleanText($_POST['newPassword']);
  $confirmPassword = cleanText($_POST['confirmPassword']);
  $role=cleanText($_POST['role']);
  $agree=$_POST['agree'];
  $status='pending';

if ($firstName=="" ||$email=="" ||$newPassword=="") {
    $Message = "First Name or password or email is empty";
    header("Location:../registration.php?error={$Message}");
} else {
        register($conn, $firstName, $lastName, $email, $newPassword, $confirmPassword, $role, $status);
}
