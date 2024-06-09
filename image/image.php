<?php
session_start();
header("Access-Control-Allow-Origin: *");
// Include database connection
include '../dataBase/dataBaseConnection.php';
echo $_SERVER['REQUEST_METHOD'];
$targetDirectory = "uploads/";
$targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

$placeId = $_POST["placeId"];

$targetFileWithIds = $targetDirectory . $placeId . "_" . $imageId . "." . $imageFileType;

if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFileWithIds)) {
    // Insert image path into database
    $imagePath = $targetFileWithIds;
    $sql = "INSERT INTO images (place_id, image_url) VALUES ('$placeId', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        echo $targetFileWithIds; // Return the path to the uploaded image
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading image.";
}

$conn->close();


?>