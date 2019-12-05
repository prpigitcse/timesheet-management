<?php
require_once('dbConnect.php');
require_once('functions.php');
session_start();

if (isset($_POST['submit'])){

       
             $firstname = cleantext($_POST['firstname']);
             $lastname = cleantext($_POST['lastname']);
             $email = cleantext($_POST['email']);
             $password = cleantext($_POST['password']);
             $cpassword = cleantext($_POST['confirmpassword']);
             register($email,$password,$cpassword);
            
}
?>