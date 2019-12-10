<?php
if ($_SESSION['csrf_token'] === $_POST['token']) {
require_once('../php/functions.php');
$conn = connectionDB();
$msg = htmlspecialchars($_POST['remarks']);
$status = htmlspecialchars($_POST['status']);
$file_id = htmlspecialchars($_POST['fileid']);

$sql = "UPDATE files SET status=? WHERE fileid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si',$status,$file_id);
if($stmt->execute()){
    echo "Updated CSV Status <br>";
}
else{
    echo "Error updating record: ";
}

$sql = "SELECT registration.uid AS uid FROM files,registration WHERE registration.uid = files.uid AND files.fileid = $file_id";
$result = $conn->query($sql);
$row = $result->fetch_array();
$reply_to = $row['uid'];

$sql = "SELECT uid from registration WHERE role = 'admin'";
$result = $conn->query($sql);
$row = $result->fetch_array();
$from = $row['uid'];

$sql = "INSERT INTO remarks (fileid,reply_from,reply_to,message,created_at) VALUES(?,?,?,?,now())";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iiis',$file_id,$from,$reply_to,$msg);
if($stmt->execute()){
    echo "Updated Remarks <br>";
}
else{
    echo "Error updating record: ";
}
}
 ?>
