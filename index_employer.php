<?php
include("./static/header.php");

// print_r($_SESSION);

// // Check if the user is logged in
// if (!isset($_SESSION['id'])) {
//     // If not logged in, display an alert and redirect to sign_in.php
// 	echo "<script>alert('Please sign in first to post a job.')</script>";
// 	echo "<script>window.location.href = 'sign_in_employer.php';</script>";
// 	exit; 
// }



?>



<div class="container">
	<div class="row justify-content-center">
		<h4 class="mt-5"> 1.6 Lakh+ companies in India used Indeed to hire in 2022.</h4>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-6 mt-5">
			<h1 class=" displays fw-bold mt-5"> Let's hire your next great candidate. <span><i>Fast.</i></span></h1>
		</div>
		<div class="col-lg-6 mt-5">
			<img src="./assets/img/job.avif" alt="profile" width="100%">
		</div>
	</div>
</div>
<div class="container">
	<a href="post_your_job.php"> <button type="submit" id="submit" id="post_jobs" class="btn btn-primary"> Post your job here        
	</button> </a> 
</div>


<?php
include("./static/footer.php");
?>

