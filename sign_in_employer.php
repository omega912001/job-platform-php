<?php
include("./static/header.php");
?>


<section class="py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<form id="form">

					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
					</div>

					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">

						<button type="submit" id="submit" class="btn btn-primary mt-3">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<script> 
		$(document).ready(function(){
			$("#form").submit(function(e){
				e.preventDefault();

				var email = $("#email").val();
				var password = $("#password").val();

				const json_data = {
					email : email,
					password: password
				};


				$.ajax({
					url:'./functions/read/register_employer_submit.php',
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
									window.location.replace("see_your_posted_jobs.php");
								}

							});
						}

					}

				})
			})
		})



	</script>