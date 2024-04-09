<?php
include("../../db/connection.php");
include("./static/header.php");
?>

<section>
	<div class="container">
		<div id="jobs"></div>
	</div>
</section>

<script>
	$(document).ready(function () {
        var action = 'get_all_jobs';
        $.ajax({
            url: './functions/read/get_jobs_by_employer.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: action 
            },
            success: function(response){
                console.log(response);
                const data = response?.data;
                let html = '';
                data.forEach((item) => {
                    html += `
                    <div class="container mt-5"> 

                    <div class="card" style="width: 160rem;">
                    <div class="card-body">
                    <h6 class="fw-bold"> Job Title: ${item.job_title} </h6>
                    <h6 class="fw-bold"> Company Name: ${item.name_of_company}</h6>
                    <h6 class="fw-bold"> Address : ${item.address} </h6>
                    <h6 class="fw-bold"> Job category :${item.job_category}</h6>
                    <h6 class="fw-bold"> Job type : ${item.job_type} </h6>
                    <h6 class="fw-bold"> Job schedule : ${item.job_schedule}</h6>
                    <h6 class="fw-bold"> Total Vacancy: ${item.total_vacancy} </h6>
                    <h6 class="fw-bold"> Salary : ${item.salary}</h6>
                    <h6 class="fw-bold"> Work Timings :${item.work_timings}</h6>
                    <a class="btn btn-success" href="see_who_applied_job.php?id=${item.id}" role="button">See who applied for this job</a>

                    </div>
                    </div>
                    </div>`;
                });
            $("#jobs").html(html); // Set the concatenated HTML to the #jobs element
        }
    });
    });

</script>






<?php 
include("./static/footer.php");
?>