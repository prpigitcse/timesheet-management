<?php
session_start();
require_once("functions.php");
$conn = connectionDB();
$fileid = $_GET['fileid'];
if(isset($_POST['Send'])){
    $msg = $_POST['reply'];
    if(!empty($msg)){
        $uid = $_SESSION['uid'];
        $admin = 101;
        $result = insertRemarks($conn, $fileid, $uid, $admin, $msg);
        if($result){
            $result1 = selectFilesUsingFileid($conn, $fileid);
            while($row1 = $result1 -> fetch_assoc()){
                $path = $row1['path'];
                header("Location:../viewcsvfile.php?path={$path}");
            }
        }
    }
    else {
        $result = selectFilesUsingFileid($conn, $fileid);
                while($row = $result -> fetch_assoc()){
                    $path = $row['path'];
                    $error = "Reply box is Empty";
                    header("Location:../viewcsvfile.php?path={$path}&error={$error}");
                }
    }
}
?>