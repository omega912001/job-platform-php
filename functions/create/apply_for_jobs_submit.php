<?php
include("../../db/connection.php");

// Check if all required fields are set
if (!isset($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['notice'], $_FILES['resume'], $_POST['jobid'])) {
	
	$result = ['error' => true, 'message' => 'All fields are required.'];
	
	echo json_encode($result);
	
	exit();
}

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$notice = $_POST['notice'];
$resume = $_FILES['resume'];
$jobid = $_POST['jobid'];

// Check if file was uploaded successfully

if ($resume['error'] !== UPLOAD_ERR_OK) {
	
	$result = ['error' => true, 'message' => 'Sorry, there was an error uploading your file.'];
	
	echo json_encode($result);
	
	exit();
}


$file_ext = strtolower(pathinfo($resume['name'], PATHINFO_EXTENSION));

if ($file_ext !== "pdf") {

	$result = ['error' => true, 'message' => 'Sorry, only PDF files are allowed.'];

	echo json_encode($result);

	exit();
}


if ($resume["size"] > 500000) {

	$result = ['error' => true, 'message' => 'Sorry, the file is too large.'];

	echo json_encode($result);

	exit();
}

// Generate a unique name for the uploaded file

$target_dir = "../../assets/img/";
$target_file = $target_dir . uniqid() . '.pdf';


if (!move_uploaded_file($resume["tmp_name"], $target_file)) {

	$result = ['error' => true, 'message' => 'Sorry, there was an error moving the uploaded file.'];

	echo json_encode($result);

	exit();
}


$sql = "INSERT INTO job_forms (fullname, email, phone, notice_period, resume, job_id) 
VALUES ('$fullname', '$email', '$phone', '$notice', '$target_file', '$jobid')";


if ($conn->query($sql) === TRUE) {

	$result = ['error' => false, 'message' => 'Your form submitted successfully.'];

	echo json_encode($result);

} else {

	$result = ['error' => true, 'message' => 'Error: ' . $conn->error];

	echo json_encode($result);
}

$conn->close();
?>