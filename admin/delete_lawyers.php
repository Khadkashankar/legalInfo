<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $lawyerId = $_POST['id'];

        $query = "SELECT profile_picture FROM lawyers WHERE lawyer_id = $lawyerId";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profilePicture = $row['profile_picture'];

            $queryDelete = "DELETE FROM lawyers WHERE lawyer_id = $lawyerId";
            $resultDelete = $conn->query($queryDelete);

            if ($resultDelete) {
                $filePath = './lawyerimages/' . $profilePicture;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }
}

mysqli_close($conn);
?>
