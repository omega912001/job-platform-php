<?php
include("./db/connection.php");
include ("./static/header.php");
include("./utils/function.php");
?>


<div class="container">
  <h2 class="fw-bold"> Jobs applied by you are as follows:- </h2>
  <div id="jobs_applied">
  </div>
</div>


<script>
  $(document).ready(function(){
    var action = 'jobs';
    $.ajax({

     url:'./functions/read/get_applied_jobs.php',
     type: 'POST',
     data: {
      action: action
    },
    dataType:'json',
    success: function(response){
      console.log(response);
      const data = response?.data;
      console.log(response.data);
      let html = '';
      data.forEach((item) => {
        html += `
        <div class="container mt-5"> 

        <div class="card" style="width: 160rem;">
        <div class="card-body">
        <h6 class="fw-bold">  ID : ${item.id} </h6>
        <h6 class="fw-bold">  Applied by : ${item.fullname}</h6>
        <h6 class="fw-bold"> Email : ${item.email} </h6>
        <h6 class="fw-bold"> Phone :${item.phone}</h6>
        <h6 class="fw-bold"> Notice Period : ${item.notice_period} </h6>
        
        <h6 class="fw-bold"> Job ID : ${item.job_id} </h6>
        <h6 class="fw-bold"> Status : ${item.status}</h6>
        <h6> Job Details : ${item.job_dets.job_details}</h6>
        </div>
        </div>
        </div>`;
      });
      $("#jobs_applied").html(html) 
    }
  });
  });


</script>

































<?php 
include("./static/footer.php");

?>