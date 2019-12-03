<?php
    session_start();
    if(!isset($_SESSION["user"]))
        header("Location: login.php");
    else{
        $uid=$_SESSION['uid'];
        $query = mysqli_query("SELECT * FROM files where uid='$uid'");
        $num = mysqli_num_rows($query);
        echo $num;
    }
?>