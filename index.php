<?php
session_start();
include("./static/header.php");


// print_r($_SESSION);

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // If not logged in, display an alert and redirect to sign_in.php
	echo "<script>alert('Please sign in first to view/apply for a job.')</script>";
	echo "<script>window.location.href = 'sign_in.php';</script>";
	exit; 
}





?>





<section class="mt-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-6">
				<div class="input-group mb-3">
					<button class="btn btn-outline-secondary"> <i class="fa-solid fa-magnifying-glass"></i></button>
					<input type="text" class="form-control" placeholder="Job title, keywords or company name" aria-label="Search Job" aria-describedby="button-addon2">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="input-group mb-3">
					<button class="btn btn-outline-secondary"><i class="fa-solid fa-location-dot"></i></button>
					<input type="text" class="form-control" placeholder="City, state, zip code" aria-label="Search Job" aria-describedby="button-addon2">
					<button class="btns" type="submit"> Find jobs</button>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="container">
	<div class="row align-items-left">
		<a href="dashboard_user.php"> Visit Dashboard </a>
	</div>
</div>


<section>
	<div class="container"> 
		<div class="row justify-content-center">
			<div class="col-md-6 mt-5">
				<h1 class="text-center fw-bold"> <u>Find your jobs </u></h1>
			</div>
		</div>
	</div>
</section>

<section id="job-listings">
	<div class="container">
		<!-- Job listings will be displayed here dynamically -->
	</div>
</section>



<script>
	$(document).ready(function () {
        // AJAX call to fetch jobs posted by the employer
		$.ajax({
			url: './functions/read/all_jobs_front_end.php',
			type: 'POST',
			dataType: 'json',
			data: { action: 'get_all_jobs' },
			success: function(response){
				console.log(response);
				const data = response?.data;
				let html = '';
				data.forEach((item) => {
					html += `
					<div class="row justify-content-center">
					<div class="col-md-6 mt-5">
					<div class="card" style="width: 100%;">
					<div class="card-body">
					<h1 class="card-title">${item.job_title}</h1>
					<h6 class="card-subtitle mb-2 text-muted">${item.name_of_company}<br>${item.address}</h6>
					<button class="money fw-bold">Salary :  ${item.salary}</button>
					<button class="money fw-bold">Job Type :  ${item.job_type}</button>
					<button class="money fw-bold">Job Schedule : ${item.job_schedule}</button>
					<br><br>
					<button class="money fw-bold">Total Vacancy : ${item.total_vacancy}</button>
					<br><br>
					<button class="money fw-bold">Work Timings : ${item.work_timings}</button>
					<br>
					<br>
					<h6>Easily apply by clicking on apply now<i class="fa-solid fa-arrow-right"></i></h6>
					<a class="btn btn-success" href="apply_for_job.php?id=${item.id}" role="button">Apply now</a>
					</div>
					</div>
					</div>
					</div>`;
				});
				$("#job-listings .container").html(html);
			}
		});
	});
</script>
<?php
include("./static/footer.php"); 
?>