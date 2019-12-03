<?php
$path = $_GET['path'];
require_once('dbcreate.php');
if (isset($_POST['submit'])) {

    $sql = "UPDATE files SET status='" . $_POST['status'] . "' WHERE path='" . $path . "'";

    if ($conn->query($sql) === TRUE) {
        header("Location: user-timesheet.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Timesheet Table</title>
    <link rel="stylesheet" type="text/css" href="csvtable.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <h2 class="text-center">Timesheet Table</h2>
    <div style='overflow-x:auto;'>
        <table>
            <?php
            $f = fopen("file/" . $path, "r");
            while (($line = fgetcsv($f)) !== false) {
                echo "<tr>";
                foreach ($line as $cell) {
                    echo "<td>" . htmlspecialchars($cell) . "</td>";
                }
                echo "</tr>\n";
            }
            fclose($f);
            ?>
        </table>
    </div>

    <div class="container status text-center">
        <form action="" method="post">
            <div class="row">
                <div class="col-8">
                    <select name="status" class="form-control">
                        <option value="Accepted">Accept</option>
                        <option value="Archived">Archive</option>
                        <option value="Rejected">Reject</option>
                    </select>
                </div>
                <div class="col-4">
                    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                </div>
            </div>
        </form>
    </div>

</body>

</html>