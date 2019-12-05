<?php
require_once('dbConnect.php');


function connectionDB($serverName,$dbUser,$dbPassword,$dbName)
{
        $conn = new mysqli($serverName,$dbUser,$dbPassword,$dbName);
        if($conn->connect_error)
        {
            die("Connection failed : ".$conn->connect_error);
        }
        return $conn;
}
function cleantext($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

function register($email,$password,$cpassword)
{
    $allowed = [
        'specbee.com',
    ];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $parts = explode('@', $email);
        $domain = array_pop($parts);
        if ( ! in_array($domain, $allowed)){
            
              $Message = "Invalid email address. Please enter email in the form @specbee.com";
              header("Location:registrationform.php?Message={$Message}");
          }
    
        else {
              $slquery = "SELECT 1 FROM registration WHERE email = '$email'";
              $selectresult = mysqli_query($conn,$slquery);
              if(mysqli_num_rows($selectresult)>0)
              {
                  $Message = "email already exists";
                  header("Location:registrationform.php?Message={$Message}");
                
              }
              elseif($password != $cpassword){
                   
                    $Message = "passwords doesnot match";
                    header("Location:registrationform.php?Message={$Message}");
                 
               }
               else{      
                    $hashpassword=password_hash($password,PASSWORD_DEFAULT);        
                    $query = "INSERT INTO `registration` (fname,lname,email,password) VALUES ('$firstname','$lastname','$email','$hashpassword')";
                    $result = mysqli_query($conn,$query);
                    if($result){
  
                      $Message = "User Created Successfully";
                      header("Location:registrationform.php?Message={$Message}");
                       
                    }
              }
               
        }
  
      }
}
?>
