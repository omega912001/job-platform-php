<?php
session_start();
include("./db/connection.php");
include("./static/header.php");
include("./utils/function.php");



$employer_id = $_SESSION['id'];

$data = get_employer_data($employer_id , $conn);

?>



<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			
			<h1 class="fw-bold mt-5 text-black"> Welcome <?php echo $data['firstname']; ?> , your job has been posted ... </h1>
			<a href="view_all_your_jobs.php"><button class="btn btn-warning mt-4"> View all the jobs posted by You </button></a>
			<a href="logout_employer.php"><button class="btn btn-danger mt-4">Logout </button></a>
		</div>
	</div>
</div>


<?php
include("./static/footer.php");
?>

