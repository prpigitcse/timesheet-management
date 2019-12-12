<?php
require_once("functions.php");
$fileData = fopen($_FILES['csvFile']['tmp_name'], 'r');
$column = fgetcsv($fileData);
$output=cleanText($fileData);
while (!feof($fileData)) {
        $rowData[]=fgetcsv($fileData);
}

$output = array(
    'column'  => $column,
    'rowData'  => $rowData
  );
echo json_encode($output);
