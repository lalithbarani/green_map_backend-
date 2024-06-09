<?php
session_start();
header("Access-Control-Allow-Origin: *");

// Include database connection
include '../dataBase/dataBaseConnection.php';

$review_id =  $_POST['review_id'];
$palce_id =  $_POST['palce_id'];
$user_id = $_POST['user_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$sql = "UPDATE map_data 
        SET
        palce_id = '$palce_id',
        user_id = '$user_id',
        rating = '$rating',
        comment = '$comment',
        WHERE 
        review_id='$review_id'";

if ($pdo->exec($sql) !== false) {
    echo "update successfully";
} else {
    echo "Error inserting record: " . $pdo->errorInfo()[2];
}
?>
