<?php
require_once("dbDetails.php");


$conn =mysqli_connect( $dbhost,$dbuser, $dbpassword,$dbName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
echo "Connected successfully";
}

?>