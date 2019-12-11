$(document).ready(function() {

  $('#confirmPassword').on('keyup', function () {
      if ($('#newPassword').val() == $('#confirmPassword').val()) {
          $('#message').html('Matching').css('color', 'green');
      } else
          $('#message').html('Not Matching').css('color', 'red');
  });

  $('#confirmPassword').on('keyup', function () {
      if ($('#newPassword').val() == $('#confirmPassword').val()) {
          $('#message').html('Matching').css('color', 'green');
      } else
          $('#message').html('Not Matching').css('color', 'red');
  });
$("#currentPassword").on('change',function() {
      var cPassword = $("#currentPassword").val();
      var uId = $("#userId").val();
      $.ajax({
          type: "POST",
          url: 'php/currentPasswordCheck.php',
          data: { currentPassword : cPassword, userId : uId } , 
          success: function(data) {
              $("#currentPasswordErrMsg").html(data).css({'color':'red','font-size':'12px'});
          }
      });
  });
  $("#fname").keypress(function (e) {
      var keyCode = e.keyCode || e.which;
      var regex = /^[A-Za-z ]+$/;
      var isValid = regex.test(String.fromCharCode(keyCode));
      if (!isValid) {
          $("#fnErrorMsg").html("Only Alphabets allowed.").css({'color':'red','font-size':'12px'});
      }
      else{
          $("#fnErrorMsg").html(" ");
      }
      return isValid;
  });
  $("#lname").keypress(function (e) {
      var keyCode = e.keyCode || e.which;
      var regex = /^[A-Za-z ]+$/;
      var isValid = regex.test(String.fromCharCode(keyCode));
      if (!isValid) {
          $("#lnErrorMsg").html("Only Alphabets allowed.").css({'color':'red','font-size':'12px'});
      }
      else{
          $("#lnErrorMsg").html(" ");
      }
      return isValid;
  });
  $("#status").change(function(e) {
    var val = $(this).val();
    e.preventDefault();
    $.ajax({
    url: 'php/filterUsers.php',
    type: 'post',
    data: {
        status: val
    },
    success: function(response) {
        $("#response").html(response);
    }

});
});

$("#submitaction").click(function(e) {
e.preventDefault();
var val = $('#action option:selected').val();
if(val=='none')
{
    alert("Select an action");

}   else {
        if($(".selectuser:checked").length > 0) {
            var selectedUserId = [];
            $('.selectuser').each(function() {
                if ($(this).is(":checked")) {
                    selectedUserId.push($(this).val());
                }
            });

            $.ajax({
                url: 'php/userStatusUpdate.php',
                type: 'post',
                data: {
                    status: val,
                    userId : selectedUserId
                },
                success: function(response) {
                    $("#response").html(response);
                    $("#message").text('Status Updated');

                }
            });
        }   else{
                alert("Select users");
            }
    }
});

});
