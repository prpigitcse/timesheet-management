<?php
function connectionDB($serverName,$dbUser,$dbPassword,$dbName)
{
        $conn = new mysqli($serverName,$dbUser,$dbPassword,$dbName);
        if($conn->connect_error)
        {
            die("Connection failed : ".$conn->connect_error);
        }
        return $conn;
}
?>
