<?php

function connectionDb()
{
    $serverName="localhost";
    $dbUser="root";
    $dbPassword="specbee";
    $dbName="timesheetDB";

    $conn = new mysqli($serverName, $dbUser, $dbPassword, $dbName);
    if ($conn -> connect_error) {
        die("Connection failed : ".$conn->connect_error);
    }
    return $conn;
}

function cleanText($string)
{
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

function register($conn, $firstname, $lastname, $email, $password, $cpassword, $role, $status)
{
    $allowed = [
      'specbee.com',
    ];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $parts = explode('@', $email);
        $domain = array_pop($parts);

        if (!in_array($domain, $allowed)) {
            $Message = "Invalid email address. Please enter email in the form @specbee.com";
            header("Location:../registration.php?error={$Message}");
        } else {
            $slquery = "SELECT 1 FROM registration WHERE email = '$email'";
            $selectresult = $conn->query($slquery);
            if ($selectresult->num_rows > 0) {
                $Message = "Email already exists";
                header("Location:../registration.php?error={$Message}");
            } elseif ($password != $cpassword) {
                $Message = "Passwords doesnot match";
                header("Location:../registration.php?error={$Message}");
            } else {
                $hashpassword=password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO registration (fname,lname,email,password,role,status) VALUES (?, ?,?, ?, ?,?)");
                $stmt->bind_param("ssssss", $firstname, $lastname, $email, $hashpassword, $role, $status);
                $result=$stmt->execute();
                if ($result) {
                    $Message = "User Created Successfully";
                    header("Location:../index.php?error={$Message}");
                }
            }
        }
    }
}


function selectAllReg($conn, $filter)
{
    if ($filter == "all") {
        $user_reg_details_query="SELECT * from registration";
    } else {
        $user_reg_details_query="SELECT * from registration where status='".$filter."'";
    }
    $userRegDetailsResults=$conn->query($user_reg_details_query);

    return $userRegDetailsResults;
}

function selectReg($uid, $conn)
{
    $user_reg_details_query="SELECT * from registration where uid='$uid'";
    $userRegDetailsResults=$conn->query($user_reg_details_query);

    return $userRegDetailsResults;
}

function selectUser($uid, $conn)
{
    $user_details_query="SELECT * from user_details where uid='$uid'";
    $user_details_results=$conn->query($user_details_query);

    return $user_details_results;
}

function updateReg($data, $conn)
{
    $stmt = $conn->prepare("UPDATE registration SET fname=?, lname=? WHERE uid=?");
    $stmt->bind_param("ssi", $data['fname'], $data['lname'], $data['uid']);
    $stmt->execute();
}

function updateRegWithPass($data, $conn)
{
    $stmt = $conn->prepare("UPDATE registration SET fname=?, lname=?, password=? WHERE uid=?");
    $stmt->bind_param("sssi", $data['fname'], $data['lname'], $data['hashPassword'], $data['uid']);
    $stmt->execute();
}

function updateUserWithImage($data, $conn)
{
    $stmt = $conn->prepare("UPDATE user_details SET address=?, bio=?, project=?,image=? WHERE uid=?");
    $stmt->bind_param("ssssi", $data['add'], $data['bio'], $data['proj'], $data['image'], $data['uid']);
    $stmt->execute();
}
function updateUserWithoutImage($data, $conn)
{
    $stmt = $conn->prepare("UPDATE user_details SET address=?, bio=?, project=? WHERE uid=?");
    $stmt->bind_param("sssi", $data['add'], $data['bio'], $data['proj'], $data['uid']);
    $stmt->execute();
}

function insertUserWithImage($data, $conn)
{
    $stmt = $conn->prepare("INSERT INTO user_details (uid,address,bio,project,image) VALUES (?, ?,?, ?, ?)");
    $stmt->bind_param("issss", $data['uid'], $data['add'], $data['bio'], $data['proj'], $data['image']);
    $stmt->execute();
}
function insertUserWithoutImage($data, $conn)
{
    $stmt = $conn->prepare("INSERT INTO user_details (uid,address,bio,project) VALUES (?, ?,?, ?)");
    $stmt->bind_param("isss", $data['uid'], $data['add'], $data['bio'], $data['proj']);
    $stmt->execute();
}

function fetchReg($uid, $conn)
{
    $data=['uid'=>"$uid",'fname'=>"",'lname'=>"",'email'=>"",'role'=>"",'status'=>""];
  //fetch values from registration table for the current logged in user
    $userRegDetailsResults=selectReg($uid, $conn);

    if ($userRegDetailsResults->num_rows > 0) {
        while ($userRegDetailsRow = $userRegDetailsResults->fetch_assoc()) {
            $data['fname']=trim($userRegDetailsRow['fname']);
            $data['lname']=trim($userRegDetailsRow['lname']);
            $data['email']=trim($userRegDetailsRow['email']);
            $data['role']=trim($userRegDetailsRow['role']);
            $data['status']=trim($userRegDetailsRow['status']);
        }
    }
    return $data;
}

function fetchUser($uid, $conn)
{
    $data=['uid'=>"$uid",'add'=>"",'bio'=>"",'proj'=>"",'image'=>""];
  //fetch values from user_details table for the current logged in user
    $user_details_results=selectUser($uid, $conn);

    if ($user_details_results->num_rows > 0) {
        while ($user_details_row = $user_details_results->fetch_assoc()) {
            $data['add']=trim($user_details_row['address']);
            $data['bio']=trim($user_details_row['bio']);
            $data['proj']=trim($user_details_row['project']);
            $data['image']=trim($user_details_row['image']);
        }
    }
    return $data;
}

function userDetailsUpdate($data)
{

    $conn=connectionDb();

    if ($data['newPassword'] != $data['confirmPassword']) {
        $errorMessage="Passwords do not match";
        header("Location: ../userUpdate.php?errorMessage={$errorMessage}");
    } else {
        if (is_uploaded_file($_FILES['profile_pic']['tmp_name'])) {
            $file_tmp=$_FILES['profile_pic']['tmp_name'];
            $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
            $filedata = file_get_contents($file_tmp);
            $data['image'] = 'data:image/' . $type . ';base64,' . base64_encode($filedata);
        }
        if ($data['newPassword'] != "" && $data['confirmPassword'] != "") {
            if ($data['currentPassword'] == "") {
                $errorMessage="Enter your current password";
                header("Location: ../userUpdate.php?errorMessage={$errorMessage}");
            } else {
                $currentPassword = $data['currentPassword'];
                $userRegDetailsResults=selectReg($data['uid'], $conn);
                $userRegDetailsRow = $userRegDetailsResults->fetch_assoc();
                $dbPassword=$userRegDetailsRow['password'];
                if (password_verify($currentPassword, $dbPassword)) {
                    $data['hashPassword']=password_hash($data['confirmPassword'], PASSWORD_DEFAULT);
                    updateRegWithPass($data, $conn);
                } else {
                    $errorMessage="Enter valid current password";
                    header("Location: ../userUpdate.php?errorMessage={$errorMessage}");
                }
            }
        } else {
            updateReg($data, $conn);
        }
        $user_details_results=selectUser($data['uid'], $conn);

        if ($user_details_results->num_rows > 0) {
            while ($user_details_row = $user_details_results->fetch_assoc()) {
                if ($data['image'] == "") {
                    updateUserWithoutImage($data, $conn);
                } else {
                    updateUserWithImage($data, $conn);
                }
            }
        } else {
            if ($data['image'] == "") {
                insertUserWithoutImage($data, $conn);
            } else {
                insertUserWithImage($data, $conn);
            }
        }
        header("Location: ../userDetails.php");
    }
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


function colorDark($from)
{
    if ($from == 'admin') {
        echo "darker";
    }
}

function msgPosition($from)
{
    if ($from == 'admin') {
        echo "msg-right";
    }
}

function timePosition($from)
{
    if ($from == 'admin') {
        echo "time-left";
    } else {
        echo "time-right";
    }
}

function msgTime($date)
{
    $date=date_create($date);
    echo date_format($date, "h:i M d");
}
function insertFiles($conn, $uid, $tmpfile, $status)
{
    $stmt = $conn->prepare("INSERT INTO files (uid,path,status) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $uid, $tmpfile, $status);
    $stmt->execute();
}
