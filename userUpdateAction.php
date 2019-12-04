<?php

session_start();
require_once("dbConnect.php");
require_once("function.php");
require_once("fetch.php");


function userDstailsUpdate($conn)
{

 if(isset($_POST['back']))
 {
    header("Location:userDetails.php");
 }

 if(isset($_POST['submit']))
 {
    if(isset($_POST['csrf_token']))
    {

        if($_SESSION['csrf_token'] === $_POST['csrf_token'])
        {
        $uid=$_SESSION['uid'];
        // $uid="9";

        $fname=cleantext($_POST['fname']);
        $lname=cleantext($_POST['lname']);
        $password=cleantext($_POST['newpassword']);
        $cpassword=cleantext($_POST['confirmpassword']);
        $add=cleantext($_POST['address']);
        $bio=cleantext($_POST['bio']);
        $proj=cleantext($_POST['project']);
        
        if($password != $cpassword)
        {
            $errormessage="Passwords do not match";
            header("Location:userUpdate.php?errormessage={$errormessage}");

        }
        else
        {

            if(is_uploaded_file($_FILES['profile_pic']['tmp_name']))
            {
                $file_tmp=$_FILES['profile_pic']['tmp_name'];
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
            else
            {
        header("Location:login.php");          
            }
    }
    else
    {
       header("Location:login.php");        
    }
 }

}//end of function

userDstailsUpdate($conn);


?>