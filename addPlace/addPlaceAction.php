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

// Include database connection
include '../dataBase/dataBaseConnection.php';


$jsonData = file_get_contents('php://input');
// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);
// Check if decoding was successful
if ($data !== null) {
   // Access the data and perform operations
    $place_name =  $data['place_name'];
    $place_categories = $data['place_categories'];
    $place_size = isset($data['place_size']) ? $data['place_size'] : "";
    $description = isset($data['description']) ? $data['description'] : ""; 
    $latitude = isset($data['latitude']) ? $data['latitude'] : ""; 
    $longitude = isset($data['longitude']) ? $data['longitude'] : ""; 
    $country = isset($data['country']) ? $data['country'] : ""; 
    $state = isset($data['state']) ? $data['state'] : ""; 
    $district =  isset($data['district']) ? $data['district'] : "";
    $area = isset($data['area']) ? $data['area'] : "";
    $created_by = isset($data['created_by']) ? $data['created_by'] : ""; 
} else {
   // JSON decoding failed
   http_response_code(400); // Bad Request
   echo "Invalid JSON data";
}



$sql = "INSERT INTO map_data (place_name, place_categories,latitude,longitude,country,area,district) 
        VALUES ('$place_name', '$place_categories','$latitude','$longitude','$country','$area','$created_by')";
if (mysqli_query($conn, $sql) !== false) {
    $response = [
        'status' => 'success',
        'message' => 'New record inserted successfully',
        'data' => $data
    ];
    http_response_code(200); // Created

    // echo "New record inserted successfully";
} else {
    $response = [
            'status' => 'error',
            'message' => 'Error inserting record: ' . mysqli_error($conn)
        ];
    http_response_code(500); // Internal Server Error
}

header('Content-Type: application/json');
echo json_encode($response);

?>




