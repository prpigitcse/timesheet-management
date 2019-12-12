
$(document).ready(function(){


function newPasswordMatching ( confirmPassword, newPassword )
    {
        if(confirmPassword != "") {
            if (confirmPassword == newPassword) {
                $('#passwordError').text('Matching').removeClass("textRed").addClass("textGreen");
            } else{
                $('#passwordError').text('Not Matching').removeClass("textGreen").addClass("textRed");
            }
        }
        else{
            $('#passwordError').text('');
        }
}


    function confirmPasswordMatching (confirmPassword,newPassword)
    {
        if(confirmPassword != ""){
            if(newPassword != ""){
                if (newPassword == confirmPassword) {
                    $('#passwordError').text('Matching').removeClass("textRed").addClass("textGreen");
                } else{
                    $('#passwordError').text('Not Matching').removeClass("textGreen").addClass("textRed");
                }
        }
        else{
            $('#passwordError').text('Not Matching').removeClass("textGreen").addClass("textRed");
        }
        }
        else{
            $('#passwordError').text('');
        }
    }

    function alphabetCheck (keyCode)
    {
        var regex = /^[A-Za-z ]+$/;
        var isValid = regex.test( String.fromCharCode( keyCode ) );
        return isValid;
    }

    $( '#newPassword' ).on( 'keyup', function () {
        let confirmPassword = $( '#confirmPassword' ).val();
        let newPassword = $( '#newPassword' ).val();
        newPasswordMatching(confirmPassword,newPassword);
    });
    $( '#confirmPassword' ).on( 'keyup', function () {
        let confirmPassword = $( '#confirmPassword' ).val();
        let newPassword = $( '#newPassword' ).val();
        confirmPasswordMatching(confirmPassword,newPassword);
    } );
    $("#firstName").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        var isValid = alphabetCheck( keyCode );
        if (!isValid) {
            $("#fnError").text("Only alphabets allowed.").addClass("textRed");
        } else{
            $("#fnError").text(" ");
        }
        return isValid;
    } );

    $("#lastName").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        var isValid = alphabetCheck( keyCode );
        if (!isValid) {
            $("#lnError").text("Only alphabets allowed.").addClass("textRed");
        } else{
            $("#lnError").text("");
        }
        return isValid;
    } );



    $("#submit").click(function(event){
      if (!(document.getElementById("checkbox").checked))
      {
        event.preventDefault();
        $("#conError").text("Please accept the terms and conditions").addClass("textRed");

      }
      else{
        $("#myForm").submit();
      }

    } );

    $("#email").change(function() {
      var email = $("#email").val();

      $.ajax({
       type: "POST",
       url: 'php/emailCheck.php',
       data: "email="+ email, 

       success: function(data) {
         $("#emailError").text(data).addClass("textRed");
      }
      });

      });
    });
