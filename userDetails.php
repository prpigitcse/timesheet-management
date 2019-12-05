<?php
session_start();
require_once("dbConnect.php");
require_once("function.php");
require_once("fetch.php");

// if(!isset($_SESSION["user"]))
//         header("Location: login.php");
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
            <div class=" col-sm user_details card" style="width: 50rem;">
                <div class="user_profile_div text-center">

                    <?php
            
            if($image != "")
            {?>
                    <img src="<?php echo $image;?>" class="img-fluid img-thumbnail user_profile_pic " alt="profile">
                    <?php } 
            else
            {?>
                    <img src="images/avatar.jpg" alt="profile" class="img-fluid img-thumbnail user_profile_pic">
                    <?php }  ?>

                    <h2 class="card-title">Welcome <?php echo $fname;?></h2>
                </div>

                <div class="row">

                    <div class="col-sm">
                        <br>
                        <b>Name:</b> <?php echo $fname." ".$lname;?>
                        <br>
                        <b>Email:</b> <?php echo $email;?>
                        <br>
                        <b>Location:</b> <?php echo $add;?>
                    </div>
                    <div class="col-sm">
                        <br>
                        <b>Project Details:</b> <?php echo $proj;?>
                        <br>
                        <b>Interests:</b> <?php echo $bio;?>
                    </div>

                </div>

                <div class="text-center">
                    <a href="userUpdate.php" class="btn btn-success">Update Profile</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</body>

</html>