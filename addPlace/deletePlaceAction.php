<?php
session_start();
header("Access-Control-Allow-Origin: *");

// Include database connection
include '../dataBase/dataBaseConnection.php';

// Check if it's a DELETE request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the raw input data
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if place_id is provided in the request body
    if (isset($data['place_id'])) {
        // Get place_id from the request body
        $place_id = intval($data['place_id']);

        // Prepare the SQL statement
        $sql = "DELETE FROM `map_data` WHERE place_id = ?";
        
        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $place_id);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Success message
            echo json_encode(array("message" => "Record deleted successfully"));
        } else {
            // If the query fails, handle the error
            echo json_encode(array("error" => mysqli_error($conn)));
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If place_id is not provided in the request
        echo json_encode(array("error" => "Missing place_id in request body"));
    }
} else {
    // If it's not a DELETE request
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("error" => "Only DELETE requests are allowed"));
}

// Close the connection
mysqli_close($conn);
?>
