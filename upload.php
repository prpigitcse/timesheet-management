<?php
session_start();
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
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
    <form enctype="multipart/form-data" action="file_upload.php" method="post" id="uploadfile"> 
        <label>Upload CSV file : </label><br>
        <input type="file" name="csvfile" id="csvfile" value="" class="text-center"/> <br><br>
        <input type="submit" name="uploadCSV" value="Upload" class="btn btn-primary" />
    </form>
    <br>
    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
    </div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

</body>
</html>