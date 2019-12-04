<?php 
require_once('dbDetails.php');
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn) {
    echo "Failed";
}
