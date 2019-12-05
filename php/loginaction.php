<?php
session_start();
include_once("php/functions.php");
if (isset($_POST["login"])) {
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $conn = connectionDB();
        $result = $conn->query("SELECT * FROM registration WHERE email='".$email."'");
        $num = $result->num_rows;
        if ($num != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $dbemail = $row['email'];
                $dbpass = $row['password'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $uid = $row['uid'];
            }
            if ($email == $dbemail && password_verify($pass, $dbpass)) {
                if ($email == "admin@specbee.com")
                    header("Location:user-timesheet.php");
                else {
                    $_SESSION['user'] = $fname.$lname;
                    $_SESSION['uid'] = $uid;
                    header("Location:home.php");
                }
            } else{
                $error='Incorrect Email or Password';
                header("Location:index.php?error={$error}");
            }
        } else{
            $error='Invalid Email or Password';
            header("Location:index.php?error={$error}");
        }
    } else{
        $error='Required all fields!!';
        header("Location:index.php?error={$error}");
    }
}
?>
