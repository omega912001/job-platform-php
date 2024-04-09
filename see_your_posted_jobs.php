<?php 
session_start();
include("./db/connection.php");
include ("./static/header.php");
include("./utils/function.php");

$employer_id = $_SESSION['id'];


$data = get_employer_data($employer_id , $conn);



?>


<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<h1 class="fw-bold mt-5"> Welcome <?php echo $data['firstname'];?>, you can now post a job for free ... </h1>
			
		</div>
	</div>
</div>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6 mt-3">
			<section class="py-5">
				
				<form id="form">

					<div class="mb-3">
						<label for="title" class="form-label fw-bold">Job Title</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Enter your job title">
					</div>

					<div class="mb-3 mt-4">
						<label for="company" class="form-label fw-bold">Name of Company</label>
						<input type="text" class="form-control" id="company" name="company" placeholder="Enter your Company's name" >
					</div>

					<div class="mb-3">
						<label for="address" class="form-label fw-bold">Address</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="Enter your address">
					</div>


					<div class="mb-3">
						<label for="category" class="form-label fw-bold">Which category best describes this job? </label>
						<input type="text" class="form-control" id="category" name="category" placeholder="Enter your job category">

					</div>

					<div class="mb-3">
						<label for="time" class="form-label fw-bold">Is it a part time of full time job?</label>
						<input type="text" class="form-control" id="time" name="time" placeholder="Enter your job type">
					</div>


					<div class="mb-3">
						<label for="schedule" class="form-label fw-bold">What is the schedule for this job?</label>
						<input type="text" class="form-control" id="schedule" name="schedule" placeholder="Day/Night shift /Flexible shift/ Rotational shift">
					</div>

					
					<div class="mb-3">
						<label for="hire" class="form-label fw-bold">How many people you want to hire? </label>
						<input type="text" class="form-control" id="hire" name="hire" placeholder="No. of people to be hired">
					</div>

					<div class="mb-3">
						<label for="pay" class="form-label fw-bold">What is the pay ?</label>
						<input type="text" class="form-control" id="pay" name="pay" placeholder="Enter minimum amount to maximum amount per month">
					</div>

					<div class="mb-3">
						<label for="timing" class="form-label fw-bold">What are the work timings?</label>
						<input type="text" class="form-control" id="timing" name="timing" placeholder="Monday-Friday / Monday-Saturday">
					</div>

					<div class="mb-3">
						<label for="details" class="form-label fw-bold">Job Details</label>
						<input type="text" class="form-control" id="details" name="details" placeholder="Enter job details">
					</div>


					<input type="hidden" id="employer_id" name="employer_id" value= "<?php echo ($employer_id) ?>" >





					<button type="submit" id="submit" class="btn btn-primary">Submit</button>
					<br>
					<br>
					<br>
					<a class="fw-bold" href="dashboard_employer.php"> Go to the Dashboard </a>
				</form>
			</div>
		</div>
	</div>
</section>
<script>
	$(document).ready(function(){
		$("#form").submit(function(e){
			e.preventDefault();
			var data = $('#form').serialize(); 
			$.ajax({
				url:'./functions/create/see_your_posted_jobs_submit.php',
				type:'POST',
				data: data,
				dataType:'json',
				success:function(response){
					
					if(response.error){
						Swal.fire({
							title: "",
							text: response.message,
							icon: "error"
						});
					} else {
						Swal.fire({
							title: response.message,
							showDenyButton: false,
							showCancelButton: false,
							confirmButtonText: "Ok",
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.replace("dashboard_employer.php");
							}

						});
					}
				}

			});
		});
	});



</script>
