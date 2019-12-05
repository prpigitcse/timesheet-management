<?php
require_once('dbConnect.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Timesheet Table</title>
    <link rel="stylesheet" type="text/css" href="csvtable.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
<?php require_once('header.php'); ?>
    <h2 class="text-center">Timesheet Table</h2>
    <div style='overflow-x:auto;'>
        <table>
            <?php
            $f = fopen("file/" . $_GET['path'], "r");
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
        <!-- <form id="updateForm" action="" method=""> -->
            <div class="row">
                <div class="col-8">
                    <select id="status" name="status" class="form-control">
                        <option value="none" selected disabled hidden> Select an Option </option> 
                        <option value="Accepted">Accept</option>
                        <option value="Archived">Archive</option>
                        <option value="Rejected">Reject</option>
                    </select>
                </div>
                <div class="col-4">
                    <input id="submit" class="btn btn-primary" type="submit" name="submit" value="Submit">
                </div>
            </div>
        <!-- </form> -->
        <div id="response" class="container mt-2"></div>
    </div>

    <script>
        $(document).ready(function() {
            $("#submit").click(function(e) {
                var val = $('#status option:selected').val();
                e.preventDefault();
                $.ajax({
                url: 'update.php',
                type: 'post',
                data: {
                    status: val,
                    fileid: '<?php echo $_GET['fileid'];; ?>'
                },
                success: function(response) {
                    $("#response").text('Status Updated Successfully')
                }
            });
            });
        });
    </script>

</body>

</html>