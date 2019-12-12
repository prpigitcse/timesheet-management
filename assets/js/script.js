$(document).ready(function() {

    function newPasswordMatching (confirmPassword,newPassword)
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


    $("#currentPassword").on('change',function() {
        var cPassword = $("#currentPassword").val();
        var uId = $("#userId").val();
        $.ajax({
            type: "POST",
            url: 'php/currentPasswordCheck.php',
            data: { currentPassword : cPassword, userId : uId } , 
            success: function(data) {
                $("#currentPasswordErrMsg").text(data).addClass("textRed");
            }
        });
    });

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
    });

    $("#lastName").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        var isValid = alphabetCheck( keyCode );
        if (!isValid) {
            $("#lnError").text("Only alphabets allowed.").addClass("textRed");
        } else{
            $("#lnError").text("");
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

$("#submitAction").click(function(e) {
    e.preventDefault();
    var val = $('#action option:selected').val();
    if(val=='none')
    {
        alert("Select an action");

    }   else {
            if($(".selectUser:checked").length > 0) {
                var selectedUserId = [];
                $('.selectUser').each(function() {
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
                        $("#statusMessage").text('Status Updated').addClass("statusMessage");

                    }
                });
            }   else{
                    alert("Select users");
                }
        }
    });

});
