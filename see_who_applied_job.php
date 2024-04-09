<?php
session_start();
include("../../db/connection.php"); 
include("./static/header.php");


$user_id;

if(isset($_GET["id"])){
    $user_id = $_GET["id"];
}

?>

<div class="container">
    <div class="row justify-content-center">
        <div id="jobs_applied">
        </div>
    </div>
</div>

<script>
   $(document).ready(function(){
    var id = <?php echo $user_id ?>;
    console.log(id);

    $.ajax({
        url: './functions/read/see_jobs_details.php',
        type: 'POST',
        data: {
            id: id // Pass the id as an object property
        },
        dataType: 'json',
        success: function(response){
            console.log(response);
            const data = response?.data;
            let html = ''; // Initialize an empty string to store HTML content
            data.forEach((item) => {
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
                <h5> Job Id: ${item.job_id}</h5><br>
                <h5> Status: ${item.status}</h5><br>
                ${item.status === "pending" ? `<button class="btn btn-success" onclick="acceptUser('${item.email}', this)">Accept</button>
                <button class="btn btn-danger" onclick="rejectUser('${item.email}', this)">Reject</button>`  : ""}
                
                </div>
                </div>
                </div>
                </div>`;
            });
            $("#jobs_applied").html(html);

            // condition ? output : df
        }
    });
});

   function acceptUser(email, button) {
    updateUserStatus(email, 'accepted', button);
}

function rejectUser(email, button) {
    updateUserStatus(email, 'rejected', button);
}

function updateUserStatus(email, status, button) {
    $.ajax({
        url: './functions/update/update_user_status.php',
        type: 'POST',
        data: {
            email: email,
            status: status
        },
        dataType: 'json',
        success: function(response) {
            if(response.success) {
                alert('User status updated successfully');
                // Remove both accept and reject buttons for the user being accepted or rejected
                $(button).siblings('button').remove();
                $(button).remove(); // Remove the clicked button

                // $('.btn-success').remove();
                // $('.btn-danger').remove();


            } else {
                alert('Failed to update user status');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
</script>
