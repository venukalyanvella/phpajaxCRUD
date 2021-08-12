
<?php
class Crud
{
 //crud class
 public $connect;
 private $host = "localhost";
 private $username = 'root';
 private $password = '';
 private $database = 'studentDB';

 function __construct()
 {
  $this->database_connect();
 }

 public function database_connect()
 {
  $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->database);
 }

 public function execute_query($query)
 {
  return mysqli_query($this->connect, $query);
 }

 public function get_data_in_table($query)
 {
  $output = '';
  $result = $this->execute_query($query);
  $output .= '
  <table class="table table-bordered table-striped">
   <tr>
    <th width="10%">College id</th>
    <th width="15%">Student Name</th>
    <th width="20%">Email</th>
    <th width="15%">MobileNumber</th>
    <th width="35%">Address</th>
    <th width="5%">Update</th>
    <th width="5%">Delete</th>
   </tr>
  ';
  if(mysqli_num_rows($result) > 0)
  {
   while($row = mysqli_fetch_object($result))
   {
    $output .= '
    <tr>
    <td>'.$row->id.'</td>
     <td>'.$row->studentName.'</td>
     <td>'.$row->studentEmail.'</td>
     <td>'.$row->studentMobile.'</td>
     <td>'.$row->studentAddress.'</td>
     <td><button type="button" name="update" id="'.$row->id.'" class="btn btn-success btn-xs updateData">Update </button></td>
     <td><button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-xs delete">Delete</button></td>
    </tr>
    ';
   }
  }
  else
  {
   $output .= '
    <tr>
     <td colspan="5" align="center">No Data Found</td>
    </tr>
   ';
  }
  $output .= '</table>';
  return $output;
 } 
 

 function make_pagination_link($query, $record_per_page)
 {
  $output = '';
  $result = $this->execute_query($query);
  $total_records = mysqli_num_rows($result);
  $total_pages = ceil($total_records/$record_per_page);
  for($i=1; $i<=$total_pages; $i++)
  {
   $output .= '<span class="pagination_link" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="'.$i.'">'.$i.'</span>';
  }
  return $output;
 }
}
?>