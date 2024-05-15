<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newsId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

	$image=$_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"],"newsimages/".$_FILES["image"]["name"]);


    $query = "UPDATE news SET
                title = '$title',
                description = '$description',
                image = '$image',
                status = '$status'
              WHERE news_id = $newsId";

    $result = $conn->query($query);
}

mysqli_close($conn);
?>
