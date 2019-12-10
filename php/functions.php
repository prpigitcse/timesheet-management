<?php

function connectionDB()
{
  $serverName="localhost";
  $dbUser="root";
  $dbPassword="suresh";
  $dbName="timesheetDB";

  $conn = new mysqli($serverName,$dbUser,$dbPassword,$dbName);
  if($conn->connect_error)
  {
      die("Connection failed : ".$conn->connect_error);
  }
  return $conn;
}

function cleantext($string)
{
   $string = trim($string);
   $string = stripslashes($string);
   $string = htmlspecialchars($string);
   return $string;
}

function register($conn, $firstname,$lastname, $email, $password, $cpassword)
{
  $allowed = [
      'specbee.com',
  ];
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $parts = explode('@', $email);
    $domain = array_pop($parts);

    if (!in_array($domain, $allowed)) {
      $Message = "Invalid email address. Please enter email in the form @specbee.com";
      header("Location:../registration.php?Message={$Message}");
    } else {
      $slquery = "SELECT 1 FROM registration WHERE email = '$email'";
      $selectresult = mysqli_query($conn,$slquery);
      if (mysqli_num_rows($selectresult) > 0) {
          $Message = "email already exists";
          header("Location:../registration.php?Message={$Message}");
      } elseif ($password != $cpassword){
          $Message = "passwords doesnot match";
          header("Location:../registration.php?Message={$Message}");
      } else {
          $hashpassword=password_hash($password,PASSWORD_DEFAULT);
          $query = "INSERT INTO `registration` (fname,lname,email,password) VALUES ('$firstname','$lastname','$email','$hashpassword')";
          $result = mysqli_query($conn,$query);
          if ($result) {
            $Message = "User Created Successfully";
            header("Location:../index.php?Message={$Message}");
          }
      }
    }
  }
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

function insertUser($uid, $add, $bio, $proj, $image, $conn)
{
    $stmt = $conn->prepare("INSERT INTO user_details (uid,address,bio,project,image) VALUES (?, ?,?, ?, ?)");
    $stmt->bind_param("issss", $uid, $add, $bio, $proj, $image );
    $stmt->execute();
}

function insertFiles($conn, $uid, $tmpfile, $status)
{
    $stmt = $conn->prepare("INSERT INTO files (uid,path,status) VALUES (?, ?, ?)");
    $stmt->bind_param("iss",$uid, $tmpfile, $status);
    $stmt->execute();
}

function insertRemarks($conn, $fileid, $uid, $admin, $msg)
{
    $query = "INSERT INTO `remarks` (fileid,reply_from,reply_to,message,created_at) VALUES ('$fileid','$uid','$admin','$msg',now())";
    $result = $conn -> query($query);
    return $result;
}

function selectFilesUsingFileid($conn, $fileid)
{
    $result = $conn -> query("SELECT * FROM files where fileid='$fileid'");
    return $result;
}

function selectFilesUsingUserid($conn, $uid)
{
    $result = $conn -> query("SELECT * FROM files where uid='$uid'");
    return $result;
}

function selectFilesUsingPath($conn, $path)
{
    $result = $conn -> query("SELECT * FROM files where path='$path'");
    return $result;
}

function selectRemarksUsingFileid($conn, $fileid)
{
    $result = $conn -> query("SELECT * FROM remarks where fileid='$fileid'");
    return $result;
}

function selectRegistrationUsingEmail($conn, $email)
{
    $result = $conn->query("SELECT * FROM registration WHERE email='".$email."'");
    return $result;
}
?>
