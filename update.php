<?php
require_once('dbConnect.php');

$sql = "UPDATE files SET status='" . $_POST['status'] . "' WHERE fileid='".$_POST['fileid']."'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error updating record: " . $conn->error;
    }
 ?>