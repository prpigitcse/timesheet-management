<?php
session_start();
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
if (isset($_SESSION['admin'])) {
    require_once('php/functions.php');
    $conn = connectionDB();
    $sql = "SELECT registration.uid as uid,registration.role as role, registration.fname as reply_from, remarks.message as msg, remarks.created_at as time FROM remarks, files,registration WHERE files.fileid = remarks.fileid AND remarks.reply_from = registration.uid AND files.fileid = '" . $_GET['fileid'] . "' ";
    $result = $conn->query($sql);
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Timesheet Table</title>
        <link rel="stylesheet" type="text/css" href="assets/css/timesheet.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <h2 class="text-center">Timesheet Table</h2>
        <div style='overflow-x:auto;'>
            <table>
                <?php
                    $file = fopen("files/timesheet/" . $_GET['path'], "r");
                    while (($line = fgetcsv($file)) !== false) {
                        echo "<tr>";
                        foreach ($line as $cell) {
                            echo "<td>" . $cell . "</td>";
                        }
                        echo "</tr>\n";
                    }
                    fclose($file);
                    ?>
            </table>
        </div>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="container">
                <div class="chat-container <?php colorDark($row['role']); ?>">
                    <div class="<?php msgPosition($row['role']); ?>">
                        <b><?php echo $row['reply_from']; ?>:</b>
                        <p><?php echo $row['msg']; ?></p>
                    </div>
                    <div class="<?php timePosition($row['role']); ?>"><?php msgTime($row['time']); ?></div>
                </div>
            </div>
        <?php } ?>

        <div class="container status text-center">
            <!-- <form id="updateForm" action="" method=""> -->
            <div class="row">
                <div class="col-4">
                    <select id="status" name="status" class="form-control">
                        <option value="none" selected disabled hidden> Select an Option </option>
                        <option value="Accepted">Accept</option>
                        <option value="Archived">Archive</option>
                        <option value="Rejected">Reject</option>
                    </select>
                </div>
                <div class="col-6">
                    <textarea id="remarks" class="form-control" name="message" rows="4" placeholder="Remarks"></textarea>
                </div>
                <div class="col-2">
                    <input id="submit" class="btn btn-primary" type="submit" name="submit" value="Submit">
                </div>
            </div>
            <!-- </form> -->
            <div id="response" class="container mt-2"></div>
        </div>

        <script>
            $(document).ready(function() {

                $("#submit").click(function(e) {
                    var status_val = $('#status option:selected').val();
                    if ($('#remarks').val().length != 0 && status_val != 'none') {
                        var remarks_val = $('#remarks').val();
                        e.preventDefault();
                        $.ajax({
                            url: 'php/updateCsvStatus.php',
                            type: 'post',
                            data: {
                                remarks: remarks_val,
                                status: status_val,
                                fileid: '<?php echo $_GET['fileid']; ?>',
                                csrf: '<?php echo $token; ?>'
                            },
                            success: function(response) {
                                location.reload();
                            }
                        });
                    }
                    else{
                        $('#response').text('Add Remarks and Status');
                    }

                });
            });
        </script>

    </body>

    </html>
<?php
} else {
    echo "Acces Denied";
}

?>