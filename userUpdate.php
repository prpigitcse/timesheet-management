<?php
session_start();

require_once("dbConnect.php");
require_once("function.php");

$uid=$_SESSION['uid'];
// $uid="1";
$fname="";
$lname="";
$email="";
$add="";
$bio="";
$proj="";
$image="";

$user_reg_details_results=selectReg($uid,$conn);

if($user_reg_details_results->num_rows > 0)
{
    while($user_reg_details_row = $user_reg_details_results->fetch_assoc())
    {
        $fname=trim($user_reg_details_row['fname']);
        $lname=trim($user_reg_details_row['lname']);
        $email=trim($user_reg_details_row['email']);
    }
}

//fetch values from user_details table

$user_details_results=selectUser($uid,$conn);

if($user_details_results->num_rows > 0)
{
    while($user_details_row = $user_details_results->fetch_assoc())
    {
        $add=trim($user_details_row['address']);
        $bio=trim($user_details_row['bio']);
        $proj=trim($user_details_row['project']);
        $image=trim($user_details_row['image']);  
      
    }
}




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
<?php require_once("header.php");?>

<div class="container">
  <div class="row">
    
    <div class="user_details card" style="width: 50rem;">

    <h2 class="card-title">Update Profile</h2>
    
        
        <form action="" method="post" id="registration"  enctype="multipart/form-data">
        
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
        <input type="submit" class="btn btn-warning" name="back" value="<< Back" >
            <input type="submit" class="btn btn-primary" name="submit" value="Update" >
  
        </form>
    </div>
    </div>
    </div>

<?php
 if(isset($_POST['back']))
 {
    header("Location:userDetails.php");

 }
 if(isset($_POST['submit']))
 {
    
$uid=$_SESSION['uid'];
    // $uid="1";

    $fname=cleantext($_POST['fname']);
    $lname=cleantext($_POST['lname']);
    $password=cleantext($_POST['newpassword']);
    $cpassword=cleantext($_POST['confirmpassword']);
    $add=cleantext($_POST['address']);
    $bio=cleantext($_POST['bio']);
    $proj=cleantext($_POST['project']);
    
    if($password != $cpassword)
    {
        echo "<script>alert('Passwords does not match');</script>";
    }
    else
    {

        if(is_uploaded_file($_FILES['profile_pic']['tmp_name']))
        {
            // $profile_pic= $_FILES['profile_pic']['name'];
            $file_tmp=$_FILES['profile_pic']['tmp_name'];
            // $target = 'images/'.$profile_pic;
            // $image=base64_encode($profile_pic);
            // move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
            $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
            $data = file_get_contents($file_tmp);
            $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
            
          
        }



        if($password!="" && $cpassword!="")
        {
           $hashpassword=password_hash($password,PASSWORD_DEFAULT);
            updateRegWithPass($uid, $fname, $lname, $email,$hashpassword,$conn);
        }
        else
        {
            updateReg($uid, $fname, $lname, $email,$conn);
        }
       

        $user_details_results=selectUser($uid,$conn);
        
        if($user_details_results->num_rows > 0)
        {
            while($user_details_row = $user_details_results->fetch_assoc())
            {
                updateUser($add, $bio,$proj,$image, $uid,$conn);
            }
        }
        else
        {
                insertUser($uid, $add, $bio,$proj,$image,$conn);
        }

       header("Location:userDetails.php");

    }
   
 }






?>




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