<?php
session_start();
include ("../../db/connection.php");

$company = $_POST['company'];
$number = $_POST['number'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$enycrypt_pass = md5($password);
$cpass = $_POST['cpass'];
$phone = $_POST['phone'];

if($password != $cpass){
	$result = ['error' => true , 'message' => 'Password does not match'];
	echo json_encode($result);
	exit();
}

$sql = "INSERT INTO employers (name_of_company , number_of_employees , firstname , lastname , email , password ,
	phone )
VALUES('$company', '$number', '$fname', '$lname', '$email', '$enycrypt_pass', '$phone')";


if ($conn->query($sql) === TRUE) {
	
	$result = [ 'error' => false , 'message' => 'Congrats! your account created successfully.' ];
	echo json_encode($result);
	exit();

} else {

	$result = [ 'error' => true , 'message' => "Error: " . $sql . "<br>" . $conn->error ];
	echo json_encode($result);
	exit();


}

$conn->close();
?>

