<!DOCTYPE html >
<html lang="en">
<head>
	<title>Test</title>
</head>
<body>
    <form enctype="multipart/form-data" action="" method="post"> 
        <table> 
            <tr> 
                <td class="width"><label for="image">Upload CSV file : </label></td> 
                <td><input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                    <input type="file" name="csvfile" id="csvfile" value=""/></td> 
                <td><input type="submit" name="uploadCSV" value="Upload" /></td> 
            </tr> 
        </table> 
    </form>
</body>
</html>
<?php
$has_title_row = true;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(is_uploaded_file($_FILES['csvfile']['tmp_name'])){
        $filename = basename($_FILES['csvfile']['name']);
        if(substr($filename, -3) == 'csv'){
            $tmpfile = $_FILES['csvfile']['tmp_name'];
            if (($fh = fopen($tmpfile, "r")) !== FALSE) {
                $i = 0;
                while (($items = fgetcsv($fh, 10000, ",")) !== FALSE) {
                    if($has_title_row === true && $i == 0){ 
                        $i++;
                        continue;
                    }
                    print_r($items);
                    $i++;
                }
            }
        }
        else{
            die('Invalid file format uploaded. Please upload CSV.');
        }
    }
    else{
        die('Please upload a CSV file.');
    }
}
?>