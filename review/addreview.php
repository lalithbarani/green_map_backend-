<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No Content
    exit();
}
// Include your database connection file
include '../dataBase/dataBaseConnection.php';

// Get the raw POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo "Invalid JSON";
    exit;
}

// Validate and sanitize input
$place_id = filter_var($data['place_id'], FILTER_SANITIZE_NUMBER_INT);
$user_id = filter_var($data['user_id'], FILTER_SANITIZE_NUMBER_INT);
$rating = filter_var($data['rating'], FILTER_SANITIZE_NUMBER_INT);
$comment = filter_var($data['comment'], FILTER_SANITIZE_STRING);

if (empty($place_id) || empty($user_id) || empty($rating) || empty($comment)) {
    http_response_code(400);
    echo "All fields are required.";
    exit;
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO reviews (place_id, user_id, rating, comment) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("iiis", $place_id, $user_id, $rating, $comment);

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

