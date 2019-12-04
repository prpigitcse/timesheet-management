<?php
require_once("dbConnect.php");
require_once("header.php");
session_start();
function upload($conn){
if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])) 
{
    $username=$_SESSION['user'];
    $uid=$_SESSION['uid'];    
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   
            if(is_uploaded_file($_FILES['csvfile']['tmp_name'])){
                $filename = basename($_FILES['csvfile']['name']);
                if ($_FILES['csvfile']['error'] > 0) {
                    echo "Return Code: " . $_FILES['csvfile']['error'] . "<br />";
                }
                else
                {
                    
                    if(substr($filename, -3) == 'csv'){
                        $fileext=substr($filename, -4);
                        $ts=strtotime("now");
                        $tmpfile = $username."-".$ts.$fileext;
                        $files='CSV_uploads/'.$tmpfile;
                        if(move_uploaded_file($_FILES['csvfile']['tmp_name'],$files)){
                            $stmt = $conn->prepare("INSERT INTO files (uid,path,status) VALUES (?, ?, ?)");
                            $stmt->bind_param("iss",$uid, $tmpfile,$status);
                            $status="N/A";
                            $stmt->execute();
                            header('location:user-timesheet.php');
                        }
                        else
                        {
                            die('<br><div style="text-align:center;">Invalid file format uploaded. Please upload CSV.</div>');
                        }
                    }
                }
            }
            else{
                die('Please upload a CSV file.');
            }
       
    
        }
    }
 else{
 
    header('location:login.php');
    echo "You need to login first!!!";
}
       
}
upload($conn);
?>