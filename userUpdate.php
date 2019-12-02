<?php
require_once("userDetails.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <div class="simple-form">
        
        <form action="" method="post" id="registration">
        
        
        <input type="text" name="firstname" placeholder="Firstname" value="<?php echo $fname;?>"><br><br>
        <input type="text" name="lastname"  placeholder="Lastname" value="<?php echo $lname;?>"><br><br>
        <input type="email" name="email" placeholder="Email" value="<?php echo $email;?>"><br><br>
        <input type="Password" name="currentpassword" placeholder="Current Password"><br><br>
        <input type="Password" name="newpassword" placeholder="New Password"><br><br>
        <input type="Password" name="confirmpassword" placeholder="Confirm Password"><br><br>
        <textarea name="address" id="" cols="30" rows="10" placeholder="Address">
        </textarea>
        <textarea name="bio" id="" cols="30" rows="10" placeholder="Your Interests...">
        </textarea>

        <input type="submit" value="Update" >
  
        </form>
    </div>



</body>
</html>