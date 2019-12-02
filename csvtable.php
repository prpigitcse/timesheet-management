<!DOCTYPE html>
<html>

<head>
    <title>Timesheet Table</title>
    <link rel="stylesheet" type="text/css" href="csvtable.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div style='overflow-x:auto;'>
        <table>
            <?php
            $f = fopen("file/timesheet.csv", "r");
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

    <div class="container buttons text-center">
        <form action="" method="post">
            <input class="btn btn-success" type="submit" name="accept" value="Accept">
            <input class="btn btn-warning" type="submit" name="archive" value="Archive">
            <input class="btn btn-danger" type="submit" name="reject" value="Reject">
        </form>
    </div>
    
</body>

</html>