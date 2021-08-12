 

 
<?php
//action.php
include 'crud2.php';
$object = new Orginazation();

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
 
   echo $object->get_data_in_table("SELECT * FROM orginazation ORDER BY id DESC LIMIT $start_from, $record_per_page");
   echo '<br /><div align="center">';
   echo $object->make_pagination_link("SELECT * FROM orginazation ORDER by id", $record_per_page);
   echo '</div><br />';
 
  }

  //insert 

if($_POST["action"] == "Insert")
 {
  $organizationName = mysqli_real_escape_string($object->connect, $_POST["orginazationName"]);
  $centers = mysqli_real_escape_string($object->connect, $_POST["centers"]);
  $stateName= mysqli_real_escape_string($object->connect, $_POST["stateName"]);
  $collage = mysqli_real_escape_string($object->connect, $_POST["collage"]);
 

  $query = "
  INSERT INTO orginazation
  (orginazation, centers, state, collage) 
  VALUES ('".$organizationName."', '".$centers."', '".$stateName."', '".$collage."')
  ";
  $object->execute_query($query);
  echo 'New Data Added successfully..';
 }

 // fetch
 if($_POST["action"] == "FetchSingleData")
 {
  $output = array();
  $query = "SELECT * FROM orginazation WHERE id = '".$_POST["id"]."'";
  $result = $object->execute_query($query);

  while($row = mysqli_fetch_array($result))
  {
   $output["orginazationName"] = $row['orginazation'];
   $output["centers"] = $row['centers'];
   $output["stateName"] = $row['state'];
   $output["collage"] = $row['collage'];  
   
   $output["id"] = $row['id'];

    }
  echo json_encode($output);
  
 }

//  edit
if($_POST["action"] == "Edit")
 {
    $orginazationName = mysqli_real_escape_string($object->connect, $_POST["orginazationName"]);
  $centers = mysqli_real_escape_string($object->connect, $_POST["centers"]);
  $stateName= mysqli_real_escape_string($object->connect, $_POST["stateName"]);
  $collage = mysqli_real_escape_string($object->connect, $_POST["collage"]);
 
  $query = "UPDATE orginazation SET orginazation = '".$orginazationName."',centers = '".$centers."', state = '".$stateName."',collage = '".$collage."' WHERE id = '".$_POST["user_id"]."'";
  $object->execute_query($query);
  echo ' Details Updated';
  //echo $query;
 }
 
//  delete

if($_POST["action"] == "Delete")
 {
  $query = "DELETE FROM orginazation WHERE id = '".$_POST["id"]."'";
  $object->execute_query($query);
  echo "Data Deleted";


 }

//  search
if($_POST["action"] == "Search")
 {
  $search = mysqli_real_escape_string($object->connect, $_POST["query"]);
  $query = "
  SELECT * FROM orginazation 
  WHERE orginazation LIKE '%".$search."%' 
  OR centers LIKE '%".$search."%' OR state LIKE '%".$search."%' OR college LIKE '%".$search."%' 
  ORDER BY id DESC
  ";
  //echo $query;
  echo $object->get_data_in_table($query);  
 }



}




?>