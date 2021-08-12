 

 
<?php
//action.php
include 'crud.php';
$object = new Crud();

if(isset($_POST["action"])){

  if($_POST["action"] == "Load")
  {
   $record_per_page = 5;
   $page = '';
 
   if(isset($_POST["page"]))
   {
    $page = $_POST["page"];
   }
   else
   {
    $page = 1;
   }
   $start_from = ($page - 1) * $record_per_page;
 
   echo $object->get_data_in_table("SELECT * FROM students ORDER BY id DESC LIMIT $start_from, $record_per_page");
   echo '<br /><div align="center">';
   echo $object->make_pagination_link("SELECT * FROM students ORDER by id", $record_per_page);
   echo '</div><br />';
 
  }

  //insert 

if($_POST["action"] == "Insert")
 {
  $organization_id = mysqli_real_escape_string($object->connect, $_POST["organizationID"]);
  $center_id = mysqli_real_escape_string($object->connect, $_POST["centerID"]);
  $state_id = mysqli_real_escape_string($object->connect, $_POST["stateID"]);
  $college_id = mysqli_real_escape_string($object->connect, $_POST["collegeID"]);
  $studentName = mysqli_real_escape_string($object->connect, $_POST["studentName"]);
  $studentEmail = mysqli_real_escape_string($object->connect, $_POST["studentEmail"]);
  $studentMobile = mysqli_real_escape_string($object->connect, $_POST["studentMobile"]);
  $studentAddress = mysqli_real_escape_string($object->connect, $_POST["studentAddress"]);

  $query = "
  INSERT INTO students
  (organization_id,center_id,state_id,college_id,studentName,studentEmail,studentMobile,studentAddress) 
  VALUES ('".$organization_id."', '".$center_id."', '".$state_id."', '".$college_id."', '".$studentName."', '".$studentEmail."', '".$studentMobile."', '".$studentAddress."')
  ";
  $object->execute_query($query);
  echo 'New Student Details Added successfully..';
 }

 // fetch
 if($_POST["action"] == "FetchSingleData")
 {
  $output = array();
  $query = "SELECT * FROM students WHERE id = '".$_POST["id"]."'";
  $result = $object->execute_query($query);

  while($row = mysqli_fetch_array($result))
  {
   $output["orginazation_id"] = $row['organization_id'];
   $output["center_id"] = $row['center_id'];
   $output["state_id"] = $row['state_id'];
   $output["college_id"] = $row['college_id'];  
   $output["studentName"] = $row['studentName'];
   $output["studentEmail"] = $row['studentEmail'];
   $output["studentMobile"] = $row['studentMobile'];  
   $output["studentAddress"] = $row['studentAddress'];
   $output["id"] = $row['id'];

    }
  echo json_encode($output);
  
 }

//  edit
if($_POST["action"] == "Edit")
 {
    $organization_id = mysqli_real_escape_string($object->connect, $_POST["orginazationID"]);
    $center_id = mysqli_real_escape_string($object->connect, $_POST["centerID"]);
    $state_id = mysqli_real_escape_string($object->connect, $_POST["stateID"]);
    $college_id = mysqli_real_escape_string($object->connect, $_POST["collegeID"]);
    $studentName = mysqli_real_escape_string($object->connect, $_POST["studentName"]);
    $studentEmail = mysqli_real_escape_string($object->connect, $_POST["studentEmail"]);
    $studentMobile = mysqli_real_escape_string($object->connect, $_POST["studentMobile"]);
    $studentAddress = mysqli_real_escape_string($object->connect, $_POST["studentAddress"]);
  $query = "UPDATE students SET organization_id = '".$organization_id."',center_id = '".$center_id."', state_id = '".$state_id."',college_id = '".$college_id."', studentName = '".$studentName."',studentEmail = '".$studentEmail."',studentMobile = '".$studentMobile."',studentAddress = '".$studentAddress."' WHERE id = '".$_POST["user_id"]."'";
  $object->execute_query($query);
  echo 'Student Details Updated';
  //echo $query;
 }
 
//  delete

if($_POST["action"] == "Delete")
 {
  $query = "DELETE FROM students WHERE id = '".$_POST["id"]."'";
  $object->execute_query($query);
  echo "Data Deleted";

  

 }

//  search
if($_POST["action"] == "Search")
 {
  $search = mysqli_real_escape_string($object->connect, $_POST["query"]);
  $query = "
  SELECT * FROM students 
  WHERE studentName LIKE '%".$search."%' 
  OR studentEmail LIKE '%".$search."%' OR studentMobile LIKE '%".$search."%' OR studentAddress LIKE '%".$search."%' 
  ORDER BY id DESC
  ";
  //echo $query;
  echo $object->get_data_in_table($query);  
 }



}




?>