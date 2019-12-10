<?php
require_once('php/functions.php');
session_start();
// If the values are posted, insert them into the database.
if( !empty( $_REQUEST['error'] ) )
{
     echo "<p style='color:red;text-align:center'>" . $_REQUEST['error'] . "</p>";
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
      <link rel="stylesheet" href="assets/css/styles.css">
  </head>
  <body>
    <div class="container">
      <div class="card formcard" style="width: 30rem;">
        <form id="myForm" method="POST" class="form-group" action="php/registrationaction.php">
          <h2 class="card-title">Registration Form</h2>

          <div class="form-group">
          <input type="text" name="firstname" class="form-control" placeholder="Firstname" id="firstname">
          <span id='fn-errormsg'></span>
          </div>

          <div class="form-group">
          <input type="text" name="lastname" class="form-control" placeholder="Lastname" id="lastname">
          <span id='ln-errormsg'></span>
          </div>

          <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Email" id="email">
          <span id='email-errormsg'></span>
          </div>

          <div class="form-group">
          <input type="Password" name="password" class="form-control" placeholder="Password" id="password">
          </div>

          <div class="form-group">
          <input type="Password" name="confirmpassword" class="form-control" placeholder="Confirm Password" id="ConfirmPassword">
          <div id='password-errormsg'></div>
          </div>

          <div class="form-group">          
          <select class="form-control" name="role">
          <option value="Management">Management</option>
          <option value="Marketing">Marketing</option>
          <option value="Backend Developers">Backend Developer</option>
          <option value="Frontend Developers">Frontend Developer</option>
          </select>
          </div>

          <div class="form-group">
          <input type="checkbox" name="agree" id="chbox"><span>I accept the terms and Condition</span>
          <div id='con-errormsg'></div>
          </div>

          <input type="submit" value="Register" id="submit" name="submit" class="btn btn-primary">
          <a href="index.php">Already have an account? Login</a>
        </form>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
   

<!-- Latest compiled and minified JavaScript -->

   
       
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#firstname").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            var regex = /^[A-Za-z ]+$/;
 
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#fn-errormsg").html("Only Alphabets allowed.").css({'color':'red','font-size':'12px'});
            }
            else{
              $("#fn-errormsg").html(" ");
            }
 
            return isValid;
        });
    });

    $(function () {
        $("#email").keypress(function (e) {
          $("#email-errormsg").html("Enter email of the form @specbee.com.").css({'color':'red','font-size':'12px'});
        });
    });

    $(function () {
        $("#lastname").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            var regex = /^[A-Za-z ]+$/;
 
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#ln-errormsg").html("Only Alphabets allowed.").css({'color':'red','font-size':'12px'});
            }
            else{
              $("#ln-errormsg").html(" ");
            }
 
            return isValid;
        });
    });



        $(document).ready(function(){
          $("#submit").click(function(event){      
            if (!(document.getElementById("chbox").checked))
            {
              event.preventDefault();
              $("#con-errormsg").html("Please accept the terms and conditions").css({'color':'red','font-size':'12px'});

            }
            else{
              $("#myForm").submit();
            }
                     
    });
});
  

      $(document).ready(function() {
          $('#ConfirmPassword').on('keyup', function () {
            if ($('#password').val() == $('#ConfirmPassword').val()) {
          $('#password-errormsg').html('Matching').css({'color':'green','font-size':'12px'});
        } else
          $('#password-errormsg').html('Not Matching').css({'color':'red','font-size':'12px'});
      });
      });

  
    </script>
  </body>
</html>
