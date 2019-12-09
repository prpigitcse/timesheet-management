<?php
session_start();
$uid = $_SESSION['uid'];
require_once("functions.php");
$conn=connectionDB();
if($_POST['month']!='All'){
    $month = $_POST['month'];
    $result = $conn -> query("SELECT * FROM files where uid='$uid'");
    ?>
    <thead>
        <tr>
            <td>File ID</td>
            <td>File Name</td>
            <td>Status</td>
        </tr>
    </thead>
    <?php
    while($row = $result -> fetch_assoc()) {
        $split = explode("-",$row['path']);
        if($month==$split[1]){
        ?>
           <tr>
                <td><?php echo $row['fileid'] ?></td>
                <td><?php echo $row['path'] ?></td>
                <td><?php echo $row['status'] ?></td>
                <td><a href="viewcsvfile.php?path=<?php echo $row['path']; ?>" type="button" class="btn btn-primary" style="margin-left:25%;">View</a>
                </td>
            </tr>
        <?php }
    }
}
else if($_POST['month']=='All') { 
    $result = $conn -> query("SELECT * FROM files where uid='$uid'");
    ?>
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
    <?php }
}
?>