<?php
require_once("dbDetails.php");

$conn=new mysqli($serverName,$dbUser,$dbPassword,$dbName);

if($conn->connect_error)
{
    die("Connection failed : ".$conn->connect_error);
}

?>