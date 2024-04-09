<?php
include("../../db/connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    if (isset($_POST["email"]) && isset($_POST["status"])) {

        $email = mysqli_real_escape_string($conn, $_POST["email"]);
       
        $status = mysqli_real_escape_string($conn, $_POST["status"]);

        

        $sql = "UPDATE job_forms SET status = '$status' WHERE email = '$email'";

        if (mysqli_query($conn, $sql)) {

            echo json_encode(array('success' => true, 'message' => 'User status updated successfully'));

        } else {

            echo json_encode(array('success' => false, 'message' => 'Failed to update user status'));
        }

    } else {

        echo json_encode(array('success' => false, 'message' => 'Missing parameters'));
    }

    mysqli_close($conn);

} else {

    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}
?>