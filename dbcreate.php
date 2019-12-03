<?php 
require_once('dbdetails.php');
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn) {
    echo "Failed";
}
