<?php
require_once('functions.php');
$conn = connectionDb();
$allowed = [
    'specbee.com',
];
$email = cleanText($_POST['email']);
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $parts = explode('@', $email);
    $domain = array_pop($parts);

    if (!in_array($domain, $allowed)) {
        echo "Invalid email address. Please enter email in the form @specbee.com";
    } else {
        $result = "SELECT COUNT(uid) FROM registration WHERE email = '$email'";
        $selectResult = $conn->query($result);
        $count=$selectResult->fetch_assoc();

        if ($count["COUNT(uid)"] > 0) {
            echo "Email already exists";
        }
    }
}
