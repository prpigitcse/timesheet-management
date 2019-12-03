<?php
$dbuser="root";
$dbpassword="specbee";
$dbhost="localhost";
$database="timesheetDB";
$conn =mysqli_connect( $dbhost,$dbuser, $dbpassword,$database);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
}
else{
echo "Connected successfully";
}

?>