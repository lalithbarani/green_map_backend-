<?php
// session_start();
// header("Access-Control-Allow-Origin: *");

// // $place_id = $_POST['place_id']; // ID of the product being reviewed
// // $user_id =$_POST['user_id'];// ID of the user writing the review
// // $rating =$_POST['rating']; // Rating given by the user
// // $comment = $_POST['comment'];

// $place_id = 123; // ID of the product being reviewed
// $user_id = 456; // ID of the user writing the review
// $rating = 4; // Rating given by the user
// $comment = "This product is great!";

// // // Prepare SQL statement
// $stmt = $conn->prepare("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
// $stmt->bind_param("iiis", $place_id, $user_id, $rating, $comment);

// // Execute the statement
// if ($stmt->execute()) {
//     echo "Review inserted successfully.";
// } else {
//     echo "Error inserting review: " . $stmt->error;
// }

// // Close statement and connection
// $stmt->close();


session_start();
header("Access-Control-Allow-Origin: *");
include '../dataBase/dataBaseConnection.php';

// Replace these variables with your actual database connection details
// $servername = "localhost";
// $username = "root";
// $password = "";
// $database = "urban_green";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $database);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
 $place_id = $_POST['place_id']; // ID of the product being reviewed
// ID of the user writing the review
 $rating =$_POST['rating']; // Rating given by the user
 $comment = $_POST['comment'];


// $place_id = 123; // ID of the product being reviewed
// $user_id = 456; // ID of the user writing the review
// $rating = 4; // Rating given by the user
// $comment = "This product is great!";

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO reviews (palce_id, rating, comment) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("iis", $place_id, $user_id, $rating, $comment);

// Execute the statement
if ($stmt->execute()) {
    echo "Review inserted successfully.";
} else {
    echo "Error inserting review: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();




?>