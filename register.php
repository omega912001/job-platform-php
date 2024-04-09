<?php 
include("./static/header.php");
?>


<section class="py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<form id="form" method="POST">
					<div class="mb-3">
						<label for="name" class="form-label fw-bold">Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" >
					</div>
					<div class="mb-3">
						<label for="email" class="form-label fw-bold">Email</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" >
					</div>
					<div class="mb-3">
						<label for="phone" class="form-label fw-bold">Phone Number</label>
						<input type="number" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" >
					</div>
					<div class="mb-3">
						<label for="password" class="form-label fw-bold">Password</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">

					</div>
					<div class="mb-3">
						<label for="cpass" class="form-label fw-bold">Confirm Password</label>
						<input type="password" class="form-control" id="cpass" name="cpass" placeholder="Confirm your password">
					</div>
					<button type="submit" id="submit" class="btn btn-primary">Submit</button>
					<p class="shortpara fw-bold"> if you are already an user ,then  <a href="sign_in.php">LOG IN</a></p>
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
				type:'POST',
				url:'./functions/create/register_user.php',
				data: data,
				dataType:'json',
				success:function(response){
					console.log(response);
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