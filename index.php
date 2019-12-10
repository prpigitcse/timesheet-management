<?php
require_once("php/functions.php");
?>

<!doctype html>
    <head>
        <title>Login</title>
        <script language="javascript" type="text/javascript">
            window.history.forward();
        </script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel='stylesheet' href='assets/css/styles.css'>
    </head>
    <body>
        <section class='container col-8 col-sm-6 col-md-6 col-lg-3 login_container'>
            <section class="row justify-content-center">
                <div>
                    <form action="php/loginaction.php" method='post'>
                        <div class="form-group">
                            <h1>Login</h1>
                            <label>Email:</label>
                            <input type="email" class="form-control" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" placeholder="Enter password" name="pass">
                        </div>
                        <?php
                            if(isset($_GET['error'])==TRUE){
                                echo "<p style='color:red;text-align:center'>".$_GET['error']."</p>";
                            }
                        ?>
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                        <a href="registration.php">New User? Register</a>
                    </form>
                </div>
            </section>
        </section>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
