<?php
require_once "functions.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
}

$conn=connectionDb();
if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
    $user=$_SESSION['user'];
    $uid=$_SESSION['uid'];
    if (isset($_POST['importCsv'])) {
        if (isset($_POST['csrfToken'])) {
            if ($_SESSION['csrfToken'] === $_POST['csrfToken']) {
                if (is_uploaded_file($_FILES['csvFile']['tmp_name'])) {
                    $fileName = basename($_FILES['csvFile']['name']);
                    if (substr($fileName, -3) == 'csv') {
                        $fileExt=substr($fileName, -4);
                        $ts=strtotime("now");
                        $tmpFile = $user."-".date("M")."-".$ts.$fileExt;
                        $files='../files/timesheet/'.$tmpFile;
                        echo $status;
                        if (move_uploaded_file($_FILES['csvFile']['tmp_name'], $files)) {
                            $status="N/A";
                            echo $status;
                            insertFiles($conn, $uid, $tmpFile, $status);
                            header('location:../home.php');
                        } else {
                                die('<br><div style="text-align:center;">Invalid file format uploaded. Please upload CSV.</div>');
                        }
                    }
                } else {
                    die('Please upload a CSV file.');
                }
            } else {
                header('location:../index.php');
            }
        } else {
            header('location:../index.php');
        }
    }
} else {
    header('location:../index.php');
}
