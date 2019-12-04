<?php

function cleantext($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}


function selectReg($uid,$conn)
{
    $user_reg_details_query="SELECT * from registration where uid='$uid'";
    $user_reg_details_results=$conn->query($user_reg_details_query);
    
    return $user_reg_details_results;

}
function selectUser($uid,$conn)
{
    $user_details_query="SELECT * from user_details where uid='$uid'";
    $user_details_results=$conn->query($user_details_query);
    
    return $user_details_results;

}

function updateReg($uid, $fname, $lname, $email, $conn)
{
    $stmt = $conn->prepare("UPDATE registration SET fname=?, lname=?, email=? WHERE uid=?");
        $stmt->bind_param("sssi", $fname, $lname, $email,$uid );

        $stmt->execute();

}
function updateRegWithPass($uid, $fname, $lname, $email,$hashpassword,$conn)
{

    $stmt = $conn->prepare("UPDATE registration SET fname=?, lname=?, email=?, password=? WHERE uid=?");
        $stmt->bind_param("ssssi", $fname, $lname, $email,$hashpassword,$uid );

        $stmt->execute();
}
function updateUser($add, $bio,$proj,$image, $uid,$conn)
{
    $stmt = $conn->prepare("UPDATE user_details SET address=?, bio=?, project=?,image=? WHERE uid=?");
    $stmt->bind_param("ssssi", $add, $bio,$proj,$image, $uid );
  

   $stmt->execute();
}

function insertUser($uid, $add, $bio,$proj,$image,$conn)
{
    $stmt = $conn->prepare("INSERT INTO user_details (uid,address,bio,project,image) VALUES (?, ?,?, ?, ?)");
        $stmt->bind_param("issss", $uid, $add, $bio,$proj,$image );

        $stmt->execute();
}

?>