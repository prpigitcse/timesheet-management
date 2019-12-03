<?php 
session_start();
include_once("dbConnect.php");
?>

<!doctype html>
<head>
    <title>Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></head>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel='stylesheet' href='login.css'>
<body>
<section class='row justify-content-center'>
    <section class='col-12 col-sm-6 col-md-3'>
        <div class="container row justify-content-center">
            <form action="" method='post'>
                <div class="form-group">
                    <h1>Login</h1>
                    <label>Email:</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" class="form-control" placeholder="Enter password" name="pass">
                </div>
                <button type="submit" class="btn btn-primary" name="login">Login</button>
          </form>
        </div>
    </section>
</section>
<?php
    if(isset($_POST["login"])){
        if(!empty($_POST['email']) && !empty($_POST['pass'])){
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $query = mysqli_query($conn, "SELECT * FROM registration WHERE email='".$email."'");
            $num = mysqli_num_rows($query);
            if($num!=0)
            {
                while($row = mysqli_fetch_assoc($query))
                {
                    $dbemail = $row['email'];
                    $dbpass = $row['password'];
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $uid = $row['uid'];
                }
                if($email == $dbemail && password_verify($pass,$dbpass))
                {
                    $_SESSION['user']=$fname.$lname;
                    $_SESSION['uid']=$uid;
                    header("Location:file_upload.php");
                }
                else
                echo "<script>alert('Incorrect Email or Password');</script>";
            }
            else
                echo "<script>alert('Invalid Email or Password');</script>";
        }
        else
            echo "<script>alert('Required all fields!!');</script>";
    }

?>
</body>
</html>