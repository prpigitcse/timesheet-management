function hideSubmit() {
  var submitBtn = document.getElementById("submission");
  if (submitBtn.style.display === "none")
  submitBtn.style.display = "block";
}

$(document).ready(function(){
  $("#csvFile").change(function () {
      $('#csvFileData').html("");
      var submitBtn = document.getElementById("submission");
      submitBtn.style.display = "none";
      var fileExtension = ['csv'];
      if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
          alert("Choose a valid format of file" );
          $('#uploadFile').trigger("reset");
      }
  });

  $('#uploadCsv').on('click', function(event){
      event.preventDefault();
      var inputCsv=document.getElementById('csvFile');
      var uploadFile=document.getElementById('uploadFile');
      if($(inputCsv).val()==""){
          alert("Please choose a CSV file");
          $('#csvFileData').html("");
          $("#uploadFile").trigger("reset");
      }
      else
      {
          $.ajax({
              url:"php/fetchCsv.php",
              method:"POST",
              data:new FormData(uploadFile),
              dataType:'json',
              contentType:false,
              cache:false,
              processData:false,
              success:function(data)
              {
                hideSubmit();
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
                if(data.rowData)
                {
                  for(var count = 0; count < data.rowData.length; count++)
                  {
                    html += '<tr>';
                    for(var count2 = 0; count2 < data.column.length; count2++)
                    {
                      html += '<td>'+data.rowData[count][count2]+'</td>';
                    }
                    html += '</tr>';
                  }
                }
                html += '</table>';
                $('#csvFileData').html(html);
              }
          });
      }
  });
});
