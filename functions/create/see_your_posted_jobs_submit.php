<?php
include ("../../db/connection.php");


$title = $_POST['title'];
$company = $_POST['company'];
$address = $_POST['address'];
$category = $_POST['category'];
$time = $_POST['time'];
$schedule = $_POST['schedule'];
$hire = $_POST['hire'];
$pay = $_POST['pay'];
$timing = $_POST['timing'];
$employer_id = $_POST ['employer_id']; 
$job_details = $_POST['details'];

$sql = "INSERT INTO posted_jobs (job_title , name_of_company	, address , job_category , job_type , job_schedule , total_vacancy , salary , work_timings , employer_id , job_details  )
VALUES ('$title' , '$company' , '$address' , '$category' , '$time' , '$schedule' , '$hire' , '$pay' , '$timing' , '$employer_id' , '$job_details' )";



if ($conn->query($sql) === TRUE) {

	$result = [ 'error' => false , 'message' => 'Congrats! your job posted successfully.' ];
	echo json_encode($result);
	exit();

} else {

	$result = [ 'error' => true , 'message' => "Error: " . $sql . "<br>" . $conn->error ];
	echo json_encode($result);
	exit();


}

$conn->close();
?>

