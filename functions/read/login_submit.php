<?php
session_start();
include ("../../db/connection.php");


$email = $_POST['email'];
$password = $_POST['password'];
$enycrypt_pass = md5($password);


$sql = "SELECT * FROM users WHERE (email = '$email' AND password = '$enycrypt_pass')" ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {

  $data = $row = $result->fetch_assoc();

  $_SESSION['id'] =  $data['id'];
  $_SESSION['check'] =  'logged_in';
  
  $result = [ 'error' =>false , 'message' => "Welcome ! You can apply for the job now" ];
  
  echo json_encode($result);
  exit();

} else {
  $result = [ 'error' => true , 'message' => "Sorry, Invalid username or password." ];
  echo json_encode($result);
  exit();
}

$conn->close();