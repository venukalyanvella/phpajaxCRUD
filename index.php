<?php
//index.php
include 'crud.php';
$object = new Crud();
?>
<html>
 <head>
  <title>Student Details</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style>
   body
   {
    margin:0;
    padding:0;
    background-color:#f1f1f1;
   }
   .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:10px;
   }
  </style>
 </head>
 <body>
  <div class="container box">
   <h3 align="center">Student Records</h3><br /><br />
   <div class="row">
   <div class="col-md-8">
    <button type="button" name="add" id="add" class="btn btn-success" data-toggle="collapse" data-target="#user_collapse">Add</button>
   </div>
   <div class="col-md-4">
    <input type="text" name="search" id="search" placeholder="Search" class="form-control" />
   </div>
   </div>
   <br />
   <br />
   <div id="user_collapse" class="collapse">
    <form method="post" id="user_form">
     <label>Organization ID</label>
     <input type="text" name="orginazationID" id="orginazationID" class="form-control" />
     <br />
     <label>Center Id</label>
     <input type="text" name="centerID" id="centerID" class="form-control" />
     <br />
     <label>State Id</label>
     <input type="text" name="stateID" id="stateID" class="form-control" />
     <br />
     <label>College ID</label>
     <input type="text" name="collegeID" id="collegeID" class="form-control" />
     <br />
     <label>Student Name</label>
     <input type="text" name="studentName" id="studentName" class="form-control" />
     <br />
     <label>Student Email-id</label>
     <input type="text" name="studentEmail" id="studentEmail" class="form-control" />
     <br />
     <label>Student Mobile Number</label>
     <input type="text" name="studentMobile" id="studentMobile" class="form-control" />
     <br />
     <label>student Address</label>
     <input type="text" name="studentAddress" id="studentAddress" class="form-control" />
     <br />
     <div align="center">
      <input type="text" name="action" id="action" />
      <input type="text" name="user_id" id="user_id" />
      <input type="submit" name="button_action" id="button_action" class="btn btn-default" value="Insert" />
     </div>
    </form>
   </div>
   <br /><br />
   <div id="user_table" class="table-responsive">
   </div>
  </div>
 </body>
</html>

<script type="text/javascript">
 $(document).ready(function(){

  load_data();

  $('#action').val("Insert");

  $('#add').click(function(){
   $('#user_form')[0].reset();
  
   $('#button_action').val("Insert");
  });
  function load_data(page)
  {
   var action = "Load";
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{action:action, page:page},
    success:function(data)
    {
     $('#user_table').html(data);
    }
   });
  }

  $(document).on('click', '.pagination_link', function(){
   var page = $(this).attr("id");
   load_data(page);
  });

  $('#user_form').on('submit', function(event){
   event.preventDefault();
   var orginazationID = $('#orginazationID').val();
   var centerID = $('#centerID').val();
   var stateID = $('#stateID').val();
   var collegeID = $('#collegeID').val();
   var studentName = $('#studentName').val();
   var studentEmail = $('#studentEmail').val();
   var studentMobile = $('#studentMobile').val();
   var studentAddress = $('#studentAddress').val();
   
   if(studentName != '' && studentEmail != ''&& studentMobile != ''&& studentAddress != '' )
   {
    $.ajax({
     url:"action.php",
     method:"POST",
     data:new FormData(this),
     contentType:false,
     processData:false,
     success:function(data)
     {
      alert(data);
      // $('#user_form')[0].reset();
      load_data();      
      $('#action').val("Insert");
      $('#button_action').val("Insert");
      
     }
    })
   }
   else
   {
    alert("All  Fields are Required");
   }
  });

  $(document).on('click', '.updateData', function(){

     var id = $(this).attr("id");
   var action = "FetchSingleData";
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{id:id, action:action},
    dataType:"json",
    success:function(data)
    {
     $('.collapse').collapse("show");
     $('#orginazationID').val(data.orginazation_id);
     $('#centerID').val(data.center_id);
     $('#stateID').val(data.state_id);
     $('#collegeID').val(data.college_id);
     $('#studentName').val(data.studentName);
     $('#studentEmail').val(data.studentEmail);
     $('#studentMobile').val(data.studentMobile);
     $('#studentAddress').val(data.studentAddress);
     $('#user_id').val(data.id);
     
     $('#button_action').val("Edit");
     $('#action').val("Edit");
    }
   });
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   var action = "Delete";
   if(confirm("Are you sure you want to delete this?"))
   {
    $.ajax({
     url:"action.php",
     method:"POST",
     data:{id:id, action:action},
     success:function(data)
     {
      alert(data);
      load_data();
     }
    });
   }
   else
   {
    return false;
   }
  });
  
  $('#search').keyup(function(){
   var query = $('#search').val();
   var action = "Search";
   if(query != '')
   {
    $.ajax({
     url:"action.php",
     method:"POST",
     data:{query:query, action:action},
     success:function(data)
     {
      $('#user_table').html(data);
     }
    });
   }
   else
   {
    load_data();
   }
  });
  
 });
</script>