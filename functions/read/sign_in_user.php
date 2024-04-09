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
  $_SESSION['email'] = $data['email'];

  $result = [ 'error' =>false , 'message' => "Welcome to the Dashboard" ];
  
  echo json_encode($result);
  exit();

} else {
  $result = [ 'error' => true , 'message' => "Sorry, Invalid username or password." ];
  echo json_encode($result);
  exit();
}

$conn->close();