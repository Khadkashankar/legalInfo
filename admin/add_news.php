<?php
include('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $description = $_POST['description'];
    $status = $_POST['status'];


	$images=$_FILES["image"]["name"];
  	move_uploaded_file($_FILES["image"]["tmp_name"],"newsimages/".$_FILES["image"]["name"]);

    $query = "INSERT INTO news (title, content, description, image, status)
              VALUES ('$title', '$content', '$description', '$images', '$status')";
    $result = $conn->query($query);
}
mysqli_close($conn);
?>
