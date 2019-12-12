<?php
session_start();
if (isset($_SESSION['admin'])) {

require_once('php/functions.php');
$conn = connectionDB();
$sql = "SELECT fileid,path,fname,files.status FROM files,registration WHERE registration.uid = files.uid AND files.status != 'Reject'";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Timesheet Table</title>
    <link rel="stylesheet" type="text/css" href="assets/css/timesheet.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="userTimesheet.php">Home</a>
                </li>
            </ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="adminApproval.php">Registered Users</a>
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

    <h2 class="text-center">User and Timesheet</h2>
    <table>
        <tr>
            <td>File ID</td>
            <td>Name</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['fileid'] ?></td>
                <td><?php echo $row['fname'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td><a class="btn btn-primary" href="timesheet.php?path=<?php echo $row['path'] ?>&fileid=<?php echo $row['fileid'] ?>">View</a></td>
            </tr>
        <?php } ?>
    </table>


</body>

</html>
<?php 
} 
else{
    echo "access denied";
}
?>