<?php 
require_once('dbConnect.php');
$sql = "SELECT fileid,path,fname,status FROM files,registration WHERE registration.uid = files.uid AND files.status != 'Reject'";
$result = $conn->query($sql); 
?>


<!DOCTYPE html>
<html>

<head>
    <title>Timesheet Table</title>
    <link rel="stylesheet" type="text/css" href="csvtable.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<?php require_once('header.php'); ?>

<h2 class="text-center">User and Timesheet</h2>
    <table>
        <tr>
            <td>File ID</td>
            <td>Name</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['fileid'] ?></td>
            <td><?php echo $row['fname'] ?></td>
            <td><?php echo $row['status'] ?></td>
            <td><a class="btn btn-primary" href="csvtable.php?path=<?php echo $row['path'] ?>&fileid=<?php echo $row['fileid'] ?>">View</a></td>
        </tr>
        <?php } ?>
    </table>


</body>

</html>