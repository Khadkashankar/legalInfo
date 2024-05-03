<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $articlesId = $_POST['id'];

        $query = "SELECT image FROM articles WHERE article_id = $articlesId";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image = $row['image'];

            $queryDelete = "DELETE FROM articles WHERE article_id = $articlesId";
            $resultDelete = $conn->query($queryDelete);

            if ($resultDelete) {
                $filePath = './articlesimages/' . $image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }
}

mysqli_close($conn);
?>
