<?php
session_start();
include("../../db/connection.php");



if(isset($_POST['id']) ){

	$id = $_POST['id'];

	$sql = "SELECT * FROM posted_jobs where id='$id' ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {
			$data [] = array(
				'id' => $row ['id'],
				'job_title' => $row ['job_title'],
				'name_of_company' => $row ['name_of_company'],
				'address' => $row ['address'],
				'job_category' => $row ['job_category'],
				'job_type' => $row ['job_type'],
				'job_schedule' => $row ['job_schedule'],
				'total_vacancy' => $row ['total_vacancy'],
				'salary' => $row ['salary'],
				'work_timings' => $row ['work_timings'],
				'job_details' => $row ['job_details'],

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
