<?php

$file_data = fopen($_FILES['csvfile']['tmp_name'], 'r');
$column = fgetcsv($file_data);
while($row = fgetcsv($file_data))
{
 $row_data[] = array(
  'Date'  => $row[0],    
  'Person'  => $row[1],
  'Project'  => $row[2],
  'Task_Deliverable'  => $row[3],
  'Time_in_Hours'  => $row[4],
  'Role'=>$row[5],
  'Time_in_Minutes'=>$row[6]
 );
}
$output = array(
 'column'  => $column,
 'row_data'  => $row_data
);
echo json_encode($output);



?>
