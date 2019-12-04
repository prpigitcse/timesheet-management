<?php
    require_once('dbConnect.php');
    session_start();
    if(!isset($_SESSION["user"]))
        header("Location: login.php");
    else{
?>
    <!DOCTYPE html>
        <head>
            <title>User Home</title>
            <!-- <link rel="stylesheet" type="text/css" href="csvtable.css"> -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        </head>
        <?php
            $uid=$_SESSION['uid'];
            $result = mysqli_query($conn, "SELECT * FROM files where uid='$uid'");
        ?>
        <body>
            <?php require_once("header.php");?>
            <table class="table table-striped table-bordered table-reponsive offset-md-2 col-md-8 mt-5">
                <thead>
                    <tr>
                        <td>File ID</td>
                        <td>File Name</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['fileid'] ?></td>
                        <td><?php echo $row['path'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </body>
    </html>
<?php } ?>