<?php
session_start();
require_once "php/functions.php";

if (!isset($_SESSION["admin"])) {
        header("Location: index.php");
}

$conn=connectionDb();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
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
    <div class="container">
        <div class="text-center py-2">
            <h2>Registered Users</h2>
        </div>

        <div class="text-center">
            <p id="statusMessage"></p>
        </div>
        <div class="row py-2">
            <div class="col-6">
                <select id="action" name="action" class="form-control">
                    <option value="none" selected disabled hidden>Select Action </option>
                    <option value="approved">Approve</option>
                    <option value="rejected">Reject</option>
                </select>
            </div>
            <div class="col-6">
                <select id="status" name="status" class="form-control">
                    <option value="none" selected disabled hidden> Filter </option>
                    <option value="all">All users</option>
                    <option value="approved">Approved users</option>
                    <option value="pending">Pending users</option>
                    <option value="rejected">Rejected users</option>
                </select>
            </div>
        </div>
        <div class="row py-2">
            <table class="table table-responsive-sm">
                <thead>
                    <tr class="thead-light">
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="response">
<?php

    //fetch values from registration table for all user
    $userRegDetailsResults=selectAllReg($conn, $filter="all");

if ($userRegDetailsResults->num_rows > 0) {
    while ($userRegDetailsRow = $userRegDetailsResults->fetch_assoc()) {
        if ($userRegDetailsRow['role'] != "admin") {
            $uid=$userRegDetailsRow['uid'];
            echo "<tr>";
            echo "<td>  <input type='checkbox' class='selectUser' name='selectUser[]' value='$uid'></td>";
            echo "<td>".$userRegDetailsRow['fname']." ".$userRegDetailsRow['lname']."</td>";
            echo "<td>".$userRegDetailsRow['email']."</td>";
            echo "<td>".$userRegDetailsRow['role']."</td>";
            echo "<td>".$userRegDetailsRow['status']."</td>";
            echo "</tr>";
        }
    }
}
?>
    </tbody>
</table>
    </div>
        <div class="row py-2">
            <div class="col-6">
                <input id="submitAction" class="btn btn-primary" type="submit"
                name="submitAction" value="Action">
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>
