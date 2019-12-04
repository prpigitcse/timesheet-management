<?php
require_once("dbConnect.php");
require_once("header.php");
session_start();
if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])) 
{
?>
<!DOCTYPE html >
<html lang="en">
<head>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

<script>
    $(document).ready(function(){
     $("#csvfile").change(function () {
        var fileExtension = ['csv'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Invalid format of file" );
        }
     });
    });
    </script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
</head>
<body>
<div class="container">
    <h2>Upload your timesheet file here</h2>
    <form enctype="multipart/form-data" action="" method="post" id="uploadfile"> 
        <label>Upload CSV file : </label><br>
        <input type="file" name="csvfile" id="csvfile" value="" class="text-center"/> <br><br>
        <input type="submit" name="uploadCSV" value="Upload" class="btn btn-primary"/>
    </form>
    <div id="text"></div>
    </div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

</body>
</html>
<?php
$username=$_SESSION['user'];
$uid=$_SESSION['uid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(is_uploaded_file($_FILES['csvfile']['tmp_name'])){
        $filename = basename($_FILES['csvfile']['name']);
        if(substr($filename, -3) == 'csv'){
            $fileext=substr($filename, -4);
            $ts=strtotime("now");
            $tmpfile = $username."-".$ts.$fileext;
            $files='CSV_uploads/'.$tmpfile;
            if(move_uploaded_file($_FILES['csvfile']['tmp_name'],$files)){
                $stmt = $conn->prepare("INSERT INTO files (uid,path,status) VALUES (?, ?, ?)");
                $stmt->bind_param("iss",$uid, $tmpfile,$status);
                $status="N/A";
                $stmt->execute();
                header('location:user-timesheet.php');
        }
        else{
            echo "File not Uploaded";
        }
    }
        else{
            die('<br><div style="text-align:center;">Invalid file format uploaded. Please upload CSV.</div>');
        }
    }
    else{
        die('Please upload a CSV file.');
    }
}
} else{
 echo "You need to login first!!!";
    header('location:login.php');
    }
?>