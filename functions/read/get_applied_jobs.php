<?php
session_start();
include("../../db/connection.php");
include("../../utils/function.php");



$email = $_SESSION['email'];
if(isset($_POST['action']) && $_POST['action'] == 'jobs'){


  $sql = "SELECT * FROM job_forms  WHERE email = '$email'";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      $data [] = array(
        'id' => $row ['id'],
        'fullname' => $row ['fullname'],
        'email' => $row ['email'],
        'phone' => $row ['phone'],
        'notice_period' => $row ['notice_period'],
        'resume' => $row ['resume'],
        'job_id' => $row ['job_id'],
        'status' => $row ['status'],
        'job_dets' => get_job_des($row ['job_id'], $conn),
                                                  

      );
      
    }echo json_encode(array('success' => true , 'data' => $data));

  } else {

    echo json_encode(array('success' => false , 'data' => 'No jobs found'));
  }
} else{
  echo json_encode(array('success' => false, ));

}



$conn->close();
?>



