<?php
    $path = $_GET['path'];
    require_once("php/functions.php");
    $conn =connectionDB();
    session_start();
    if(!isset($_SESSION["user"]))
        header("Location: index.php");
    else{
?>
<!doctype html>
    <head>
        <title>View File</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
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
        <script>
            $(document).ready(function() {
                $('#datatable').dataTable();
            });
        </script>
        <h2 class="text-center">Timesheet Table</h2>
        <div class="user_csvfile_table_view container">
            <table class="table table-striped table-bordered table-reponsive" id="datatable">
                <?php
                    $file = fopen("files/timesheet/" . $_GET['path'], "r");
                    while (($line = fgetcsv($file)) !== false) {
                        echo "<tr>";
                        foreach ($line as $cell) {
                            echo "<td>" .$cell. "</td>";
                        }
                        echo "</tr>\n";
                    }
                    fclose($file);
                ?>
            </table>
            <?php
            $result = selectFilesUsingPath($conn, $path);
            while($row = $result -> fetch_assoc()){
                $fileid = $row['fileid'];
            }
            $result1 = selectRemarksUsingFileid($conn, $fileid);
            while($row1 = $result1 -> fetch_assoc()){
                if($row1['reply_from']==101){ ?>
                    <div class="admin_msg_container">
                        <p>Admin:</p>
                        <p><?php echo $row1['message'] ?></p>
                        <span><?php echo $row1['created_at'] ?></span>
                    </div>
                <?php }
                else if($row1['reply_to']==101){ ?>
                    <div class="user_msg_container">
                        <p>User:</p>
                        <p><?php echo $row1['message'] ?></p>
                        <span><?php echo $row1['created_at'] ?></span>
                    </div>
                <?php }
            } ?>
            <form action="php/update_reply.php?fileid=<?php echo $fileid; ?>" method="POST" class="user_reply_box">
                <textarea rows="4" cols="60" name="reply" placeholder="Reply....."></textarea>
                <?php
                    if(isset($_GET['error'])==TRUE){
                        echo "<p style='color:red;text-align:center'>".$_GET['error']."</p>";
                    }
                ?>   
                <input type="submit" name="Send" class="btn btn-primary" style="margin-left:85%;">
            </form>    
            <a href="home.php" type="button" class="btn btn-primary" style="margin-left:5%;margin-bottom:2%">Back</a>
        </div>
    </body>
</html>
<?php } ?>