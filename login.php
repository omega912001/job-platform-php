<?php
include ("./static/header.php");
?>


<form action=""  id="dataForm">

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="mb-3 mt-5">
					<label for="email" class="form-label fw-bold">Email Address:</label>
					<input type="email" class="form-control" id="email" name="email"  aria-describedby="email" placeholder="Enter your Email- Address">
				</div>

				<div class="mb-3">
					<label for="password" class="form-label fw-bold">Password:</label>
					<input type="text" class="form-control" id="password" name="password" aria-describedby="fullname" placeholder="Enter your password">
				</div>
				<button type="submit" class="btn btn-primary">Log in</button>
				<br>
				<br>

				<p class="shortpara fw-bold">If you are a new user please <a href="register.php">Register</a></p>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$("#dataForm").submit(function(e){
				e.preventDefault();

				var email = $("#email").val();
				var password = $("#password").val();

				const json_data = {
					email : email,
					password: password
				};
				$.ajax({
					url:'./functions/read/login_submit.php',
					type:'POST',
					data:json_data,
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
									window.location.replace("apply_for_job.php");
								}

							});
						}

					}

				})
			})
		})


	</script>
	<?php
	include("./static/footer.php");
?>