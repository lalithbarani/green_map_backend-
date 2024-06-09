<?php
session_start();
header("Access-Control-Allow-Origin: *");


// Include database connection
include '../dataBase/dataBaseConnection.php';

// Get form data
$name = $_POST['name'];
// $age = $_POST['age'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// $country = $_POST['country'];
$state = $_POST['state'];
// $district = $_POST['district'];
// $area = $_POST['area'];

// SQL injection prevention
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
// $country = mysqli_real_escape_string($conn, $country);
$state = mysqli_real_escape_string($conn, $state);
// $district = mysqli_real_escape_string($conn, $district);
// $area = mysqli_real_escape_string($conn, $area);

// Check if email already exists
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    http_response_code(409); 
    $response = array("message" => "Email already exists.");
    echo json_encode($response);
} 
else {
    // Insert user into database
    $insertQuery = "INSERT INTO users (user_name, phone, email, user_password, state) 
              VALUES ('$name',  '$phone', '$email', '$password',  '$state')";
    if (mysqli_query($conn, $insertQuery)) {
        http_response_code(201); // Created
        $response = array("message" => "Sign up successful.");
        echo json_encode($response);
    } else {
        http_response_code(500); // Internal Server Error
        $response = array("message" => "Error: " . mysqli_error($conn));
        echo json_encode($response);
    }
}

// Close connection
mysqli_close($conn);
?>



