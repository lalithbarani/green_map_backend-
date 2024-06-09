<?php
session_start();
header("Access-Control-Allow-Origin: *");

// Include database connection
include '../dataBase/dataBaseConnection.php';

$place_id =  $_POST['place_id'];
$place_name =  $_POST['place_name'];
$place_categories = $_POST['place_categories'];
$place_size = $_POST['place_size'];
$description = $_POST['description'];
$latitude =$_POST['latitude'];
$longitude = $_POST['longitude'];
$country = $_POST['country'];
$state = $_POST['state'];
$district =$_POST['district'];
$area = $_POST['area'];
$created_by = $_POST['created_by'];

$sql = "UPDATE map_data 
        SET
            place_name = '$place_name',
            place_categories = '$place_categories',
            place_size = '$place_size',
            description = '$description',
            latitude = '$latitude',
            longitude = '$longitude',
            country = '$country',
            state = '$state',
            district = '$district',
            area = '$area',
            created_by = '$created_by'
        WHERE 
            place_id='$place_id'";

if ($pdo->exec($sql) !== false) {
    echo "update successfully";
} else {
    echo "Error inserting record: " . $pdo->errorInfo()[2];
}
?>
