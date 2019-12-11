<?php

session_start();

// if(!isset($_SESSION["user"]))
//         header("Location:../index.php");

require_once "functions.php";

if (isset($_POST['back'])) {
    header("Location: ../userDetails.php");
}
if (isset($_POST['submit'])) {
    if (isset($_POST['csrfToken'])) {
        if ($_SESSION['csrfToken'] === $_POST['csrfToken']) {
        // $uid=$_SESSION['uid'];
            $uid="9";
            $data=['uid'=>"$uid",
                    'fname'=>"",
                    'lname'=>"",
                    'currentPassword'=>"",
                    'newPassword'=>"",
                    'confirmPassword'=>"",
                    'add'=>"",
                    'bio'=>"",
                    'proj'=>"",
                    'image'=>""];

            $data['fname']=cleanText($_POST['fname']);
            $data['lname']=cleanText($_POST['lname']);
            $data['currentPassword']=cleanText($_POST['currentPassword']);
            $data['newPassword']=cleanText($_POST['newPassword']);
            $data['confirmPassword']=cleanText($_POST['confirmPassword']);
            $data['add']=cleanText($_POST['address']);
            $data['bio']=cleanText($_POST['bio']);
            $data['proj']=cleanText($_POST['project']);


            userDetailsUpdate($data);
        } else {
            header("Location: ../index.php");
        }
    } else {
        header("Location: ../index.php");
    }
}
