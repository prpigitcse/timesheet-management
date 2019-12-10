<?php
session_start();
include_once("functions.php");
if (isset($_POST["login"])) {
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $conn = connectionDB();
        $result = selectRegistrationUsingEmail($conn, $email);
        $num = $result->num_rows;
        if ($num != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $dbemail = $row['email'];
                $dbpass = $row['password'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $uid = $row['uid'];
                $status = $row['status'];
            }
            if($status == "pending"){
                $error = 'Your request for access is pending';
                header("Location:../index.php?error={$error}");
            }
            if($status == "rejected"){
                $error = 'Your request for access is rejected';
                header("Location:../index.php?error={$error}");
            }
            if($status == "approved"){
                if ($email == $dbemail && password_verify($pass, $dbpass)) {
                    if ($email == "admin@specbee.com"){
                        $_SESSION['admin'] = "admin";
                        header("Location:../userTimesheet.php");
                    }
                    else {
                        $_SESSION['user'] = $fname." ".$lname;
                        $_SESSION['uid'] = $uid;
                        header("Location:../home.php");
                    }
                } else{
                    $error='Incorrect Email or Password';
                    header("Location:../index.php?error={$error}");
                }
            }
        } else{
            $error='Invalid Email or Password';
            header("Location:../index.php?error={$error}");
        }
    } else{
        $error='Required all fields!!';
        header("Location:../index.php?error={$error}");
    }
}
?>
