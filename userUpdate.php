<?php
session_start();

// if(!isset($_SESSION["user"]))
//         header("Location: login.php");

require_once("dbConnect.php");
require_once("function.php");
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;

require_once("fetch.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
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
                <a class="nav-link" href="file_upload.php">Upload Files</a>
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
    if(!empty( $_REQUEST['errormessage'] ) )
    {
        $errormessage=$_REQUEST['errormessage'];
        echo "<p style='color:red;text-align:center'>" . $_REQUEST['errormessage'] . "</p>";
    }
    ?>

    <h2 class="card-title">Update Profile</h2>
    
        
        <form action="userUpdateAction.php" method="post" id="registration"  enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" class="form-control" id="fname" placeholder="Firstname" value="<?php echo $fname;?>">
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" class="form-control" id="lname" placeholder="Lastname" value="<?php echo $lname;?>">
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="Password"class="form-control"  name="newpassword" placeholder="New Password" id="password">
            <br><span id="errormessage" style="color:red;"></span>
        
        </div>
        <div class="form-group">
            <label for="ConfirmPassword">Confirm Password</label>
            <input type="Password" class="form-control" name="confirmpassword" placeholder="Confirm Password" id="ConfirmPassword">
            <br><span id="message"></span>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" class="form-control" cols="30" rows="5" placeholder="Address"><?php echo $add;?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="bio">Interests</label>
            <textarea name="bio" id="bio" class="form-control" cols="30" rows="5" placeholder="Your Interests..." ><?php echo $bio;?>
            </textarea>
        </div>
        <div class="form-group">
            <label for="project">Projects</label>
            <textarea name="project" id="project" class="form-control" cols="30" rows="5" placeholder="Your Project Details..." ><?php echo $proj;?>
            </textarea>
        </div>
        <div class="form-group">
              <label for="profile_pic">Upload Profile Picture</label>
              <input type="file" class="form-control-file" id="profile_pic" name="profile_pic" >
        </div>

        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
        <input type="submit" class="btn btn-warning" name="back" value="<< Back" >
        <input type="submit" class="btn btn-primary" name="submit" value="Update" >
  
        </form>
    </div>
    </div>
    </div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>

$(document).ready(function() {
    $('#ConfirmPassword').on('keyup', function () {
      if ($('#password').val() == $('#ConfirmPassword').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
});
</script>
</body>
</html>