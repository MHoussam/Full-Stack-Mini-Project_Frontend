<?php
include('connection.php');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = $_POST['password'];

$check_username = $mysqli->prepare("SELECT * FROM users WHERE username=?");
$check_username->bind_param('s', $username);
$check_username->execute();
$check_username->store_result();
$username_exists = $check_username->num_rows();

if ($username_exists == 0) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = $mysqli->prepare("INSERT INTO users(first_name, last_name, username, password) VALUES (?,?,?,?)");
    $query->bind_param('ssss', $first_name, $last_name, $username, $hashed_password);
    $query->execute();

    $response['status'] = "Success";
    $response['message'] = "Another message in success";
} else {
    $response['status'] = "Failed";
    $response['message'] = "Another message in fail";
}

echo json_encode($response);