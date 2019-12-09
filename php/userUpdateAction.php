<?php

session_start();

if(!isset($_SESSION["user"]))
        header("Location:../index.php");

require_once("functions.php");

if(isset($_POST['back'])) {
    header("Location: ../userDetails.php");
}
if(isset($_POST['submit'])) {
    if(isset($_POST['csrf_token'])) {
        if($_SESSION['csrf_token'] === $_POST['csrf_token']) {
        $uid=$_SESSION['uid'];
        // $uid="9";
        $data=['uid'=>"$uid",'fname'=>"",'lname'=>"",'password'=>"",'cpassword'=>"",'add'=>"",'bio'=>"",'proj'=>"",'image'=>""];

        $data['fname']=cleantext($_POST['fname']);
        $data['lname']=cleantext($_POST['lname']);
        $data['password']=cleantext($_POST['newpassword']);
        $data['cpassword']=cleantext($_POST['confirmpassword']);
        $data['add']=cleantext($_POST['address']);
        $data['bio']=cleantext($_POST['bio']);
        $data['proj']=cleantext($_POST['project']);


        userDetailsUpdate($data); 

        }   else {
            header("Location: ../index.php");          
            }
    }   else {
        header("Location: ../index.php");        
        }
}
?>