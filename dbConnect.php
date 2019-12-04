<?php
require_once("dbDetails.php");


try
{
    if ($conn = new mysqli($serverName,$dbUser,$dbPassword,$dbName)){}
    else
    {
        throw new Exception('Unable to connect');
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}
?>