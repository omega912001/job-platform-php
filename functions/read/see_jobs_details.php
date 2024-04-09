<?php
session_start();
include("../../db/connection.php");



if(isset($_POST['id']) ){

  $id = $_POST['id'];

  $sql = "SELECT * FROM job_forms where job_id='$id' ";
  $result = $conn->query($sql);




  if ($result->num_rows > 0) {
    $data = $result -> fetch_all(MYSQLI_ASSOC);
    echo json_encode(array('success' => true , 'data' => $data));

  } else {

    echo json_encode(array('success' => false , 'data' => 'No jobs found'));
  }
} else{
  echo json_encode(array('success' => false, ));

}



$conn->close();
?>


