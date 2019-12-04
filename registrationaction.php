<?php
require_once('dbConnect.php');
session_start();
$allowed = [
    'specbee.com',
];
function cleantext($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}
if (isset($_POST['submit'])){

    if(isset($_POST['csrf_token'])){
    
        echo "<script>alert('CSRF Token Verification Success')</script>";
        echo "<br>";
        if($_SESSION['csrf_token'] === $_POST['csrf_token'])
        {
            
            echo "<script>alert('CSRF Token Validation success')</script>";
             $firstname = cleantext($_POST['firstname']);
             $lastname = cleantext($_POST['lastname']);
             $email = cleantext($_POST['email']);
             $password = cleantext($_POST['password']);
             $cpassword = cleantext($_POST['confirmpassword']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

      $parts = explode('@', $email);
      $domain = array_pop($parts);
      if ( ! in_array($domain, $allowed)){
            echo "<script>alert('$email is not a valid email address. Please enter email in the form @specbee.com');window.location='registrationform.php';</script>";
        }
  
      else {
            $slquery = "SELECT 1 FROM registration WHERE email = '$email'";
            $selectresult = mysqli_query($conn,$slquery);
            if(mysqli_num_rows($selectresult)>0)
            {
                 echo "<script>alert('email already exists');window.location='registrationform.php';</script>";
              
            }
            elseif($password != $cpassword){
                  echo "<script>alert('passwords doesnot match');window.location='registrationform.php';</script>";
               
             }
             else{      
                  $hashpassword=password_hash($password,PASSWORD_DEFAULT);        
                  $query = "INSERT INTO `registration` (fname,lname,email,password) VALUES ('$firstname','$lastname','$email','$hashpassword')";
                  $result = mysqli_query($conn,$query);
                  if($result){
                     echo "<script>alert('User Created Successfully');window.location='login.php';</script>";
                     
                  }
            }
             
      }
}
}

    }
            
}
?>