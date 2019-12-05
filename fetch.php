<?php

require_once("dbConnect.php");
require_once("function.php");

if(!isset($_SESSION["user"]))
        header("Location: login.php");

$uid=$_SESSION['uid'];
// $uid="9";

$fname="";
$lname="";
$email="";
$add="";
$bio="";
$proj="";
$image="";

//fetch values fromregistration table

$user_reg_details_results=selectReg($uid,$conn);

if($user_reg_details_results->num_rows > 0)
{
    while($user_reg_details_row = $user_reg_details_results->fetch_assoc())
    {
        $fname=trim($user_reg_details_row['fname']);
        $lname=trim($user_reg_details_row['lname']);
        $email=trim($user_reg_details_row['email']);
    }
}

//fetch values from user_details table

$user_details_results=selectUser($uid,$conn);

if($user_details_results->num_rows > 0)
{
    while($user_details_row = $user_details_results->fetch_assoc())
    {
        $add=trim($user_details_row['address']);
        $bio=trim($user_details_row['bio']);
        $proj=trim($user_details_row['project']);
        $image=trim($user_details_row['image']);  
      
    }
}

?>