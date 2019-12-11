<?php
require_once 'functions.php';
$conn = connectionDb();
$currentPassword = cleanText($_POST['currentPassword']);
$userId = cleanText($_POST['userId']);

$userRegDetailsResults = selectReg($userId, $conn);
$userRegDetailsRow = $userRegDetailsResults->fetch_assoc();
$dbPassword=$userRegDetailsRow['password'];
if (!password_verify($currentPassword, $dbPassword)) {
    echo "Invalid password";
}
