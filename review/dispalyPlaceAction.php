<?php
session_start();
header("Access-Control-Allow-Origin: *");

// Include database connection
include '../dataBase/dataBaseConnection.php';

// Get place_id from the query parameter
$place_id = isset($_GET['place_id']) ? intval($_GET['place_id']) : 0;

if ($place_id > 0) {
    // Prepare the SQL statement with a WHERE clause
    $sql = "SELECT * FROM reviews WHERE place_id = $place_id";
} else {
    // If no place_id is provided, handle the error
    echo json_encode(array("error" => "Invalid or missing place_id parameter"));
    exit;
}

$result = mysqli_query($conn, $sql);

if ($result) {
    // Initialize an empty array to store the data
    $data = array();
    
    // Fetch each row and append it to the data array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    
    // Encode the data array as JSON
    $json = json_encode($data);
    
    // Output the JSON
    header('Content-Type: application/json');
    echo $json;
} else {
    // If the query fails, handle the error
    echo json_encode(array("error" => mysqli_error($conn)));
}

// Close the connection
mysqli_close($conn);
?>
