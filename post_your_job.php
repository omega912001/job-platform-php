<?php
include("./static/header.php");
?>
<div class="container">
	<section class="py-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<form id="form">
						<h3 class="fw-medium mt-3"> If you havent posted a job before,then first you'll need to create an employer account </h3>
						<h3 class=" desc fw-bold"> Already an employer? <a href="sign_in_employer.php"> Log in </a></h3> 

						<div class="mb-3 mt-4">
							<label for="company" class="form-label fw-bold">Name of Company</label>
							<input type="text" class="form-control" id="company" name="company" placeholder="Enter your Company's name" >
						</div>

						<div class="mb-3">
							<label for="number" class="form-label fw-bold">Number of employees</label>
							<input type="text" class="form-control" id="number" name="number" placeholder="Enter your no. of employees" >
						</div>

						<div class="mb-3">
							<label for="fname" class="form-label fw-bold">First Name</label>
							<input type="text" class="form-control" id="fname" name="fname" placeholder="Enter your first name" >
						</div>

						<div class="mb-3">
							<label for="lname" class="form-label fw-bold">Last Name</label>
							<input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your last name" >
						</div>

						<div class="mb-3">
							<label for="email" class="form-label fw-bold">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
						</div>

						<div class="mb-3">
							<label for="password" class="form-label fw-bold">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
						</div>


						<div class="mb-3">
							<label for="cpass" class="form-label fw-bold">Confirm Password</label>
							<input type="password" class="form-control" id="cpass" name="cpass" placeholder="Confirm your password">
						</div>


						<div class="mb-3">
							<label for="phone" class="form-label fw-bold">Phone Number</label>
							<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
						</div>


						<button type="submit" id="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script>
		$(document).ready(function() {
			$("#form").submit(function(e){
				e.preventDefault();
				var data = $('#form').serialize(); 
				$.ajax({
					url:'./functions/create/register_employer.php',
					type:'POST',
					data: data,
					dataType:'json',
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
									window.location.replace("see_your_posted_jobs.php");
								}
							});
						}
					}
				});

			});

		});










	</script>