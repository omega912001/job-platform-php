<?php

function get_user_data($user_id, $conn) {
    $response = [];
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}


function get_employer_data($employer_id, $conn) {
    $response = [];
    $sql = "SELECT * FROM employers WHERE id = $employer_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}



function get_applicant_data ($user_id , $conn){
    $response = [];
    $sql = "SELECT * FROM job_forms WHERE id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}

function get_job_des($job_id,$conn){
    $response = [];
    $sql = "SELECT * FROM posted_jobs WHERE id = $job_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $response = $result->fetch_assoc();
    }
    return $response;
}


function if_user_logged_in($data){
    if(isset ($data['id']) && isset($data['check']) && $data['check'] == 'logged_in'){
        return false;
    }
    else{
        return true;
    }
}


function hasUserApplied($email, $job_id, $conn) {
    $sql = "SELECT * FROM job_forms WHERE email = '$email' AND job_id = '$job_id'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}


?>