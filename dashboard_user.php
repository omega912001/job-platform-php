<?php
session_start();
include("./db/connection.php");
include("./static/header.php");
include("./utils/function.php");



$user_id = $_SESSION['id'];

$data = get_user_data($user_id, $conn);




$check = if_user_logged_in( $_SESSION );

if(  $check ) {
	header('Location:sign_in.php?message=please_log_in_to_visit_dashboard');
	exit;
}

?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<h1 class="fw-bold mt-5 text-black"> Welcome <?php echo $data['name']; ?>, your job has been applied ... </h1>
			<a href="view_all_applied_jobs.php"><button class="btn btn-warning mt-4"> View all the jobs applied by You </button></a>
			<a href="logout.php"><button class="btn btn-danger mt-4">Logout </button></a>
			<a href="index.php"><button class="btn btn-success mt-4">Apply for your jobs </button></a>

			
				<a href="index.php">  </a>

		</div>
	</div>
</div>
<script>

</script>


<?php
include("./static/footer.php");
?>

