<?php
session_start();

if (!isset($_SESSION["user"])) {
        header("Location: index.php");
}

$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
?>

<!DOCTYPE html >
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
            </ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="userDetails.php">User Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="upload.php">Upload Files</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Upload your timesheet file here</h2>
        <form enctype="multipart/form-data" method="post" id="uploadfile" class="upload">
            <div class="col-md-3">
                <label>Upload CSV file : </label>
            </div>
            <div class="col-md-4">
                <input type="file" name="csvfile" id="csvfile" value="" accept=".csv" class="text-center"/><br>
            </div>
            <div class="col-md-4">
                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>"/>
            </div>
            <div class="col-md-5">
                <input type="submit" name="uploadCSV" id="uploadCSV" value="Upload" class="btn btn-primary mr-2 my-2" />
            </div>
            <div class="col-md-5" id="submission" style="display:none">
                <label>Do you want to confirm submission?</label>
                <input type="submit" name="importCSV" formaction="php/file_upload.php" id="importCSV" value="Submit" class="btn btn-primary ml-2 my-2"/>
            </div>
            <div style="clear:both"></div>
        </form>
        <br>
        <div id="csv_file_data"></div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script>
    function HideSubmit() {
        var Submitbtn = document.getElementById("submission");
        if (Submitbtn.style.display === "none")
        Submitbtn.style.display = "block";
    }
    $(document).ready(function(){
        $("#csvfile").change(function () {
            $('#csv_file_data').html("");
            var Submitbtn = document.getElementById("submission");
            Submitbtn.style.display = "none";
            var fileExtension = ['csv'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Choose a valid format of file" );
                $("#uploadfile")[0].reset();
            }
        });


        $('#uploadCSV').on('click', function(event){

            event.preventDefault();
            var inputcsv=$('#csvfile')[0];
            var uploadfile=$('#uploadfile')[0];
            if($(inputcsv).val()==""){
                alert("Please choose a CSV file");
                $('#csv_file_data').html("");
                $("#uploadfile")[0].reset();
            }
            else
            {
                $.ajax({
                    url:"php/fetchcsv.php",
                    method:"POST",
                    data:new FormData(uploadfile),
                    dataType:'json',
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data)
                    {
                       HideSubmit();
                        var html = '<table class="table table-striped table-bordered">';
                        if(data.column)
                        {
                            html += '<tr>';
                            for(var count = 0; count < data.column.length; count++)
                            {
                                html += '<th>'+data.column[count]+'</th>';
                            }
                            html += '</tr>';
                        }
                        if(data.row_data)
                        {
                            for(var count = 0; count < data.row_data.length; count++)
                            {
                                html += '<tr>';
                                html += '<td class="Date" >'+data.row_data[count].Date+'</td>';
                                html += '<td class="Person" >'+data.row_data[count].Person+'</td>';
                                html += '<td class="Project" >'+data.row_data[count].Project+'</td>';
                                html += '<td class="Task/Deliverable" >'+data.row_data[count].Task_Deliverable+'</td>';
                                html += '<td class="Time in Hours" >'+data.row_data[count].Time_in_Hours+'</td>';
                                html += '<td class="Role">'+data.row_data[count].Role+'</td>';
                                html += '<td class="Time in Minutes">'+data.row_data[count].Time_in_Minutes+'</td></tr>';
                            }
                        }
                        html += '</table>';
                        $('#csv_file_data').html(html);
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
