<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articlesId = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $description = $_POST['description'];
    $status = $_POST['status'];

	$image=$_FILES["image"]["name"];
	move_uploaded_file($_FILES["image"]["tmp_name"],"articlesimages/".$_FILES["image"]["name"]);


    $query = "UPDATE articles SET
                title = '$title',
                content = '$content',
                description = '$description',
                image = '$image',
                status = '$status'
              WHERE article_id = $articlesId";

    $result = $conn->query($query);
}

mysqli_close($conn);
?>
