<?php
session_start();
header("Access-Control-Allow-Origin: *");

// Include database connection
include '../dataBase/dataBaseConnection.php';

$sql = "select * from  map_data ";
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