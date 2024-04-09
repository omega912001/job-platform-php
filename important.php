
<script> 
	$(document).ready(function () {
		var action = 'get_all_jobs';
		$.ajax({
			url:'./functions/read/get_jobs_by_employer.php',
			type:'POST',
			dataType:'json',
			data :{
				action: action 
			},
			success: function(response){
				console.log(response);
				const data = response?.data;
				data.map((item) => {
					const html = `
					<div class="container"> 
					<h2 class="card-title mt-3 mb-3">Jobs Posted by You :- </h2>
					<div class="card" style="width: 160rem;">
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


					</div>
					</div>
					</div>`
					$("#jobs").html(html)
				});

			}
		});
	});

see_who_applied_job.php



<?php
session_start();
include("../../db/connection.php"); 
include("./static/header.php");

// $job_id = $_SESSION['id'];
?>

<div class="container">
    <div class="row justify-content-center">
        <div id="jobs_applied">
        </div>
    </div>
</div>

<script>
  $(document).ready(function(){
    var action = 'see_jobs_applied';

    $.ajax({
        url: './functions/read/see_jobs_details.php',
        type: 'POST',
        data: {
            action : action
        },
        dataType: 'json',
        success: function(response){
            console.log(response);
            const data = response?.data;
            let html = ''; // Initialize an empty string to store HTML content
            data.map((item) => {
                html += `

                
                <div class= "row justify content center mt-5">
                <div class="col-md-6">
                <div class="card" style="width: 100%;">

                <div class="card-body">
                <h5>ID: ${item.id}</h5><br>
                <h5>Fullname: ${item.fullname}</h5><br>
                <h5>Email: ${item.email}</h5><br>
                <h5>Phone number: ${item.phone}</h5><br>
                <h5>Notice Period: ${item.notice_period}</h5><br>
                <h5>Resume: <img style="height:100px" src="./assets/img/${item.resume}"</h5><br>
                <h5> User Id: ${item.user_id}</h5><br>
                <h5> Status: ${item.status}</h5><br>

                <input type="hidden" name="id" value = "${item.id}">
                </div>
                </div>
                
                </div>
                </div>`;
            });
            $("#jobs_applied").html(html); // Set the concatenated HTML to the #jobs_applied element
        }
    });
});

</script>
<?php
include("./static/footer.php");
?>


see_job_details.php


<?php
session_start();
include("../../db/connection.php");

$user_id = $_SESSION['id'];


if (isset($_POST['action']) && $_POST['action'] == 'see_jobs_applied') {



  $sql = "SELECT * FROM job_forms Where id = 'user_id'";

  $result = mysqli_query($conn, $sql);


  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

      $data[] = array(
        'id' => $row['id'],
        'fullname' => $row['fullname'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'notice_period' => $row['notice_period'],
        'resume' => $row['resume'],
         'user_id' => $row['user_id'],
         'status' => $row['status'],
      );

    }
    echo json_encode(array('success' => true, 'data' => $data));

  } else {
    echo json_encode(array('success' => false, 'data' => 'No jobs found'));
  }
} else {
  echo json_encode(array('success' => false, 'data' => 'Invalid request'));
}

mysqli_close($conn);
?> 


see_job_details.php


<?php
session_start();
include("../../db/connection.php");

// $user_id = $_SESSION['id'];

if(isset($_POST['id']) ){

  $id = $_POST['id'];


  $sql = "SELECT * FROM job_forms Where job_id = '$id'";

  $result = mysqli_query($conn, $sql);
  print_r($result);

  if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

      $data[] = array(
        'id' => $row['id'],
        'fullname' => $row['fullname'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'notice_period' => $row['notice_period'],
        'resume' => $row['resume'],
        'user_id' => $row['user_id'],
        'job_id' => $row['job_id'],
        'status' => $row['status'],
      );

    }
    echo json_encode(array('success' => true, 'data' => $data));

  } else {
    echo json_encode(array('success' => false, 'data' => 'No jobs found'));
  }
} else {
  echo json_encode(array('success' => false, 'data' => 'Invalid request'));
}

mysqli_close($conn);
?>


<?php 
include("./static/header.php");
include ("./db/connection.php");
?>
view all applied jobs



<div class="container">
    <h1> hello</h1>
</div>
<div class="container">
  <h1>Applied Jobs</h1>
  <div id="applied_jobs">
    <!-- Applied jobs will be displayed here -->
  </div>
</div>

<script>
 $(document).ready(function(){
    var action = 'view_applied_jobs' ;
    $.ajax({
        url: './functions/read/get_applied_jobs.php',
        type:'POST',
        data :{
            action : action
        },
            // dataType:'json',
        success: function(response){
            console.log(response);
            const data = response?.data;
            let html = '';
            data.forEach((item) => {
                html += `  
                <div class="container mt-5"> 

                <div class="card" style="width: 160rem;">
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


                </div>
                </div>
                </div>`;
            });
            $("#applied_jobs").html(html); // Set the concatenated HTML to the #jobs element

            
        }

    });
});
</script>
</body>
</html>
 get applied jobs 


 <?php
session_start();
include("../../db/connection.php");

$employer_id = $_SESSION['id'];

if(isset($_POST['action']) && $_POST['action'] == 'view_applied_jobs'){

 

  $sql = "SELECT * FROM posted_jobs  WHERE employer_id = '$employer_id'";
  $result = $conn->query($sql);




  if ($result->num_rows > 0) {
    $data = $result -> fetch_all(MYSQLI_ASSOC);
    print_r($data);

    echo json_encode(array('success' => true , 'data' => $data));

        // while($row = $result->fetch_assoc()) {
        //     $data [] = array(
        //         'id' => $row ['id'],
        //         'job_title' => $row ['job_title'],
        //         'name_of_company' => $row ['name_of_company'],
        //         'address' => $row ['address'],
        //         'job_category' => $row ['job_category'],
        //         'job_type' => $row ['job_type'],
        //         'job_schedule' => $row ['job_schedule'],
        //         'total_vacancy' => $row ['total_vacancy'],
        //         'salary' => $row ['salary'],
        //         'work_timings' => $row ['work_timings'],

        //     );


  } else {

    echo json_encode(array('success' => false , 'data' => 'No jobs found'));
  }
}

else{
  echo json_encode(array('success' => false, 'data' => 'invalid request' ));

}



$conn->close();
?>




