<?php
require_once("dbConnect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>


    <?php


    //fetch values from registration table
    $uid="1";

    $user_reg_details_query="SELECT uid,fname,lname,email from registration where uid='$uid'";

    $user_reg_details_results=$conn->query($user_reg_details_query);

    if($user_reg_details_results->num_rows > 0)
    {
        while($user_reg_details_row = $user_reg_details_results->fetch_assoc())
        {
            $fname=$user_reg_details_row['fname'];
            $lname=$user_reg_details_row['lname'];
            $email=$user_reg_details_row['email'];
        }
    }

    //fetch values from user_details table

    $user_details_query="SELECT uid,address,bio,project,image from user_details where uid='$uid'";

    $user_details_results=$conn->query($user_details_query);

    if($user_details_results->num_rows > 0)
    {
        while($user_details_row = $user_details_results->fetch_assoc())
        {
            $address=$user_details_row['address'];
            $bio=$user_details_row['bio'];
            $project=$user_details_row['project'];
            $image=$user_details_row['image'];

        }
    }

    ?>

    <div class="user_details">
        <div class="user_profile_div"> 

            <?php
            if(isset($image))
            {?>
                <img src="<?php $image?>" alt="profile" class="user_profile_pic">
            <?php } 
            else
            {?>
                <img src="images/avatar.jpg" alt="profile" class="user_profile_pic">
            <?php }  ?>
           
            <h2>Welcome <?php $fname?></h2>
        </div>



        <div>
                
                <b>Name:</b> <?php echo $fname." ".$lname;?>
                <br>
                <b>Email:</b> <?php echo $email;?>
                <br>
                <b>Location:</b> <?php echo $address;?>
                <br>
                <b>Interests:</b> <?php echo $bio;?>
                <br>

        </div>

        <div>
                <a href="userUpdate.php">Update Profile</a>
        </div>
    </div>

</body>
</html>


