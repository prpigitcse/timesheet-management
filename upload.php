<?php
session_start();

if (!isset($_SESSION["user"])) {
        header("Location: index.php");
}

$token = md5(uniqid(rand(), true));
$_SESSION['csrfToken'] = $token;
?>

<!DOCTYPE html >
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
            </ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="userDetails.php">User Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="upload.php">Upload Files</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Upload your Timesheet file here</h2>
        <form enctype="multipart/form-data" method="post" id="uploadFile" class="upload">
            <div>
                <label>Upload CSV file : </label>
                <input type="file" name="csvFile" id="csvFile" value="" accept=".csv" />
                <input type="hidden" name="csrfToken" value="<?php echo $token; ?>"/>
            </div>
            <div>
                <input type="submit" name="uploadCsv" id="uploadCsv" value="Upload" class="btn btn-primary mr-2 my-2" />
            </div>
            <div id="submission" style="display:none">
                <label>Do you want to confirm submission?</label>
                <input type="submit" name="importCsv" formaction="php/fileUpload.php" id="importCsv" value="Submit" class="btn btn-primary ml-2 my-2"/>
            </div>
            <div style="clear:both"></div>
        </form>
        <br>
        <div id="csvFileData"></div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
