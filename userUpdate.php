<?php
session_start();

// if(!isset($_SESSION["user"]))
//         header("Location: index.php");

require_once "php/functions.php";
$token = md5(uniqid(rand(), true));
$_SESSION['csrfToken'] = $token;


$conn=connectionDb();
// $uid=$_SESSION['uid'];
$uid="9";
$dataReg=fetchReg($uid, $conn);
$dataUser=fetchUser($uid, $conn);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
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

<div class="container">
    <div class="row">

    <div class="user_details card" style="width: 50rem;">

    <?php
    if (!empty($_REQUEST['errorMessage'])) {
        $errorMessage=$_REQUEST['errorMessage'];
        echo "<p style='color:red;text-align:center'>" . $_REQUEST['errorMessage'] . "</p>";
    }
    ?>

    <h2 class="card-title">Update Profile</h2>


        <form action="php/userUpdateAction.php" method="post" id="registration"  enctype="multipart/form-data">

        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" value="<?php echo $dataReg['fname'];?>">
            <span id="fnErrorMsg"></span>
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" value="<?php echo $dataReg['lname'];?>">
            <span id="lnErrorMsg"></span>
        </div>
        <div class="form-group">
            <label for="currentPassword">Current Password</label>
            <input type="Password"class="form-control"  name="currentPassword" placeholder="Current Password" id="currentPassword">
            <span id="currentPasswordErrMsg" style="color:red;"></span>
        </div>
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="Password"class="form-control"  name="newPassword" placeholder="New Password" id="newPassword">
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="Password" class="form-control" name="confirmPassword" placeholder="Confirm Password" id="confirmPassword">
            <span id="message"></span>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Address"><?php echo $dataUser['add'];?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="bio">Interests</label>
            <textarea name="bio" id="bio" class="form-control" cols="30" rows="5" placeholder="Your Interests" ><?php echo $dataUser['bio'];?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="project">Projects</label>
            <textarea name="project" id="project" class="form-control" cols="30" rows="5" placeholder="Your Project Details" ><?php echo $dataUser['proj'];?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="profile_pic">Upload Profile Picture</label>
            <input type="file" class="form-control-file" id="profile_pic" name="profile_pic" >
        </div>
        <input type="hidden" name="uid" id="userId" value="<?php echo $uid; ?>">
        <input type="hidden" name="csrfToken" value="<?php echo $token; ?>">
        <input type="submit" class="btn btn-warning" name="back" value="<< Back" >
        <input type="submit" class="btn btn-primary" name="submit" value="Update" >
        </form>
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

<script>
$(document).ready(function() {

    $('#confirmPassword').on('keyup', function () {
        if ($('#newPassword').val() == $('#confirmPassword').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });

    $('#confirmPassword').on('keyup', function () {
        if ($('#newPassword').val() == $('#confirmPassword').val()) {
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').html('Not Matching').css('color', 'red');
    });
$("#currentPassword").on('change',function() {
        var cPassword = $("#currentPassword").val();
        var uId = $("#userId").val();
        $.ajax({
            type: "POST",
            url: 'php/currentPasswordCheck.php',
            data: { currentPassword : cPassword, userId : uId } , 
            success: function(data) {
                $("#currentPasswordErrMsg").html(data).css({'color':'red','font-size':'12px'});
            }
        });
    });
    $("#fname").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        var regex = /^[A-Za-z ]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#fnErrorMsg").html("Only Alphabets allowed.").css({'color':'red','font-size':'12px'});
        }
        else{
            $("#fnErrorMsg").html(" ");
        }
        return isValid;
    });
    $("#lname").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        var regex = /^[A-Za-z ]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lnErrorMsg").html("Only Alphabets allowed.").css({'color':'red','font-size':'12px'});
        }
        else{
            $("#lnErrorMsg").html(" ");
        }
        return isValid;
    });
});
</script>
</body>
</html>
