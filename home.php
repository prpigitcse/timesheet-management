<?php
    require_once("php/functions.php");
    session_start();
    if(!isset($_SESSION["user"]))
        header("Location: index.php");
    else{
?>
<!DOCTYPE html>

<head>
    <title>User Home</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<?php
    $uid=$_SESSION['uid'];
    $conn = connectionDB();
    $result = $conn -> query("SELECT * FROM files where uid='$uid'");
?>

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
    <div class=>Select the month:
    <select id="month" name="month">
        <option value="All">All</option>
        <option value="Jan">Jan</option>
        <option value="Feb">Feb</option>
        <option value="Mar">Mar</option>
        <option value="Apr">Apr</option>
        <option value="May">May</option>
        <option value="Jun">Jun</option>
        <option value="Jul">Jul</option>
        <option value="Aug">Aug</option>
        <option value="Sept">Sept</option>
        <option value="Oct">Oct</option>
        <option value="Nov">Nov</option>
        <option value="Dec">Dec</option>
    </select>
    </div>

    <div class="user_home_body_display">
        <div class="card col-md-8 mt-5">
            <div class="card-header">Uploaded Files</div>
            <div>
            <table class="table table-striped table-bordered table-reponsive" id="file-table">
                <thead>
                    <tr>
                        <td>File ID</td>
                        <td>File Name</td>
                        <td>Status</td>
                    </tr>
                </thead>
                <?php while($row = $result -> fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['fileid'] ?></td>
                    <td><?php echo $row['path'] ?></td>
                    <td><?php echo $row['status'] ?></td>
                    <td><a href="viewcsvfile.php?path=<?php echo $row['path']; ?>" type="button" class="btn btn-primary" style="margin-left:25%;">View</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
                </div>
        </div>
        <div class="container" style="margin: 0;">
            <h2>User Details</h2>
            <div class="card" style="width: auto;margin-top: 0px;">
                <?php
                    $result1 = $conn -> query("SELECT * FROM user_details where uid='$uid'");
                    while($row1 = $result1 -> fetch_assoc()){
                        if(!empty($row1['image']))
                            $image = $row1['image'];
                        else
                            $image = 'assets/images/avatar.jpg';
                ?>
                <img class="" src="<?php echo $image; ?>" alt="profile image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $_SESSION['user']; ?></h4>
                    <p class="card-text"><?php echo $row1['project']; ?></p>
                    <a href="userDetails.php" class="btn btn-primary">See Profile</a>
                </div>
                    <?php } ?>
            </div>
        </div>
        </div>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#month").change(function(e) {
                var val = $(this).val();
                e.preventDefault();
                $.ajax({
                    url: 'php/filefilter.php',
                    type: 'POST',
                    data: {
                        month: val
                    },
                    beforeSend : function(){
                        $("#file-table").html("Working on....");
                    },
                    success: function(data) {     
                        $("#file-table").html(data);
                    },
                });
            });
        });
    </script>
</body>

</html>
<?php }?>