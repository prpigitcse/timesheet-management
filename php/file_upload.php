<?php
require_once("functions.php");
session_start();
if(!isset($_SESSION["user"]))
        header("Location: index.php");
$conn=connectionDB();
if(isset($_SESSION['uid']) && !empty($_SESSION['uid']))
{
    $username=$_SESSION['user'];
    $uid=$_SESSION['uid'];
    if(isset($_POST['importCSV']))
    {
        if(isset($_POST['csrf_token']))
        {
            if($_SESSION['csrf_token'] === $_POST['csrf_token'])
            {
                if(is_uploaded_file($_FILES['csvfile']['tmp_name']))
                {
                    $filename = basename($_FILES['csvfile']['name']);
                    if ($_FILES['csvfile']['error'] > 0)
                    {
                        echo "Return Code: " . $_FILES['csvfile']['error'] . "<br />";
                    }
                    else
                    {
                        if(substr($filename, -3) == 'csv')
                        {
                            $fileext=substr($filename, -4);
                            $ts=strtotime("now");
                            $tmpfile = $username."-".date("M")."-".$ts.$fileext;
                            $files='../files/timesheet/'.$tmpfile;
                            if(move_uploaded_file($_FILES['csvfile']['tmp_name'],$files))
                            {
                                $status="N/A";
                                insertFiles($conn, $uid, $tmpfile, $status);
                                header('location:../home.php');
                            }
                            else
                            {
                                die('<br><div style="text-align:center;">Invalid file format uploaded. Please upload CSV.</div>');
                            }
                        }
                    }
                }
                else
                {
                    die('Please upload a CSV file.');
                }
            }
            else
            {
                header('location:../index.php');
            }
        }
        else
        {
            header('location:../index.php');
        }
    }
}
else
{
    header('location:../index.php');
}

?>
