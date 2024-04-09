<?php
include ("../../db/connection.php");

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$enycrypt_pass = md5($password);
$cpass = $_POST['cpass'];

if($password != $cpass){
	$result = ['error' => true , 'message' => 'Password does not match'];
	echo json_encode($result);
	exit();
}

$sql = "INSERT INTO users (name, email, phone, password) 
VALUES('$name' , '$email' , '$phone' , '$enycrypt_pass' )";


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

