<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $newsId = $_POST['id'];

        $query = "SELECT image FROM news WHERE news_id = $newsId";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $image = $row['image'];

            $queryDelete = "DELETE FROM news WHERE news_id = $newsId";
            $resultDelete = $conn->query($queryDelete);

            if ($resultDelete) {
                $filePath = './newsimages/' . $image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }
}

mysqli_close($conn);
?>
