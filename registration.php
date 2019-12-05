<?php
session_start();
// If the values are posted, insert them into the database.
if( !empty( $_REQUEST['Message'] ) )
{
     echo "<p style='color:red;text-align:center'>" . $_REQUEST['Message'] . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="css/registerform.css">
  </head>
  <body>
    <div class="container">
      <div class="card" style="width: 30rem;">
        <form action="php/registrationaction.php" id="registration" method="POST" class="form-group">
          <h2 class="card-title">Registration Form</h2>
          <input type="text" name="firstname" class="form-control" placeholder="Firstname"><br><br>
          <input type="text" name="lastname" class="form-control" placeholder="Lastname"><br><br>
          <input type="email" name="email" class="form-control" placeholder="Email"><br><br>
          <input type="Password" name="password" class="form-control" placeholder="Password" id="password"><br><br>
          <input type="Password" name="confirmpassword" class="form-control" placeholder="Confirm Password" id="ConfirmPassword">
          <span id='message'></span><br><br>
          <input type="submit" value="Register" id="submit" name="submit" class="btn btn-primary">
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
