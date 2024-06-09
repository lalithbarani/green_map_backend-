<?php
session_start();
header("Access-Control-Allow-Origin: *");
// Include database connection
include '../dataBase/dataBaseConnection.php';

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// SQL injection prevention
$email = mysqli_real_escape_string($conn, $email);

// Fetch user from database
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

// Check if user exists
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    // Verify password
    if (password_verify($password, $row['user_password'])) {
        http_response_code(200); // OK
        $response = array("message" => "Login successful.");
        echo json_encode($response);
    } else {
        http_response_code(401); // Unauthorized
        $response = array("message" => "Invalid email or password");
        echo json_encode($response);
    }
} else {
    http_response_code(401); // Unauthorized
    $response = array("message" => "Invalid email or password");
    echo json_encode($response);
}

// Close connection
mysqli_close($conn);
?>

