<?php 
session_start();
include("./db/connection.php");
include ("./static/header.php");
include("./utils/function.php");

// $user_id = $_SESSION['id'];
// $data = get_applicant_data($user_id , $conn);


$jobid;

if(isset($_GET["id"])){
	$jobid = $_GET["id"];
}


$email = $_SESSION['email'];

if (hasUserApplied($email, $jobid, $conn)) {

    echo "<script>alert('You have already applied for this job.')</script>";

    echo "<script>window.location.href = 'dashboard_user.php';</script>";
 
    exit();
}



?>

<script>
	$(document).ready(function(){
		var id = <?php echo $jobid ?> ;
		console.log(id);
		$.ajax({
			url:'./functions/read/view_job.php',
			type:'POST',
			data: {
				id
			},
			dataType:'json',
			success: function(response){
				console.log(response);
				const data = response?.data;

            	let html = ''; // Initialize an empty string to store HTML content

            	data.forEach((item) => {
            		html = `
            		<div class="container mt-5"> 

            		<div class="card" style="width: 180rem;">
            		<div class="card-body">
            		<h1 class="fw-bold"> Job Title: ${item.job_title} </h1>
            		<h3 class="fw-bold"> Company Name: ${item.name_of_company}</h3>
            		<h class="fw-bold"> Address : ${item.address} </h6>
            		<h6 class="fw-bold"> Job category :${item.job_category}</h6>
            		<h6 class="fw-bold"> Job type : ${item.job_type} </h6>
            		<h6 class="fw-bold"> Job schedule : ${item.job_schedule}</h6>
            		<h6 class="fw-bold"> Total Vacancy: ${item.total_vacancy} </h6>
            		<h6 class="fw-bold"> Salary : ${item.salary}</h6>
            		<h6 class="fw-bold"> Work Timings :${item.work_timings}</h6>
            		<h6 class="fw-bold"> Job Details :${item.job_details}</h6>


            		</div>
            		</div>
            		</div>`;
            	});
            	$("#jd").html(html)
            }
        });
	});


</script>
<div class="container">
	<div class="row">
		<div class="col-md-8">

			<div id="jd" style="max-width: 200px"></div>
		</div>
	</div>
	<form action="" method="POST" id="dataForm" enctype="multipart/form-data">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h2 class="mt-5"> Please fill the form below to apply for this job </h2>
					<div class="mb-3">
						<label for="fullname" class="form-label fw-bold">Full Name:</label>
						<input type="text" class="form-control" id="fullname" name="fullname" aria-describedby="fullname" placeholder="Enter your full name" required>
					</div>

					<div class="mb-3">
						<label for="email" class="form-label fw-bold">Email Address:</label>
						<input type="email" class="form-control" id="email" name="email"  aria-describedby="email" placeholder="Enter your Email- Address" required>
						<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
					</div>

					<div class="mb-3">
						<label for="phone" class="form-label fw-bold">Phone:</label>
						<input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone" placeholder="Enter your phone number" required >
					</div>

					<div class="mb-3">
						<label for="notice" class="form-label fw-bold"> Notice Period:</label>
						<input type="text" class="form-control" id="notice" name="notice" aria-describedby="phone" placeholder="Your notice period" required>
					</div>

					<div class="mb-3">
						<label for="resume" class="form-label fw-bold">Upload Your Resume:</label>
						<input type="file" class="form-control" id="resume" name="resume" aria-describedby="resume" accept="application/pdf,application/vnd.ms-excel" required>
					</div>


					<input type="hidden" id ="jobid" name="jobid" value = "<?php echo ($jobid) ?>" >

					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</form>
	<script>
		$(document).ready(function(){

			$("#dataForm").submit(function(e){
				e.preventDefault();

				var formData = new FormData(dataForm); 

				jQuery.ajax({
					type: 'POST',
					url: './functions/create/apply_for_jobs_submit.php',
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success: function(response){

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
									window.location.replace("dashboard_user.php");
								}

							});
						}
					}
				});
			});
		});

	</script>
	<?php
	include ("./static/footer.php");
	?>
