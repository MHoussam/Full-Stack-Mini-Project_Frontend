<?php
include('connection.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = $mysqli->prepare("SELECT * FROM users WHERE username=?");
$query->bind_param('s', $username);
$query->execute();

$query->store_result();
$query->bind_result($id, $first_name, $last_name, $username, $hashed_password);
$query->fetch();

$num_rows = $query->num_rows();
if ($num_rows == 0) {
    $response['status'] = "User not found";
} else {
    if (password_verify($password, $hashed_password)) {
        $response['status'] = 'Logged in';
        $response['user_id'] = $id;
        $response['first_name'] = $first_name;
        $response['username'] = $username;
    } else {
        $response['status'] = "Wrong password";
    }
}

echo json_encode($response);