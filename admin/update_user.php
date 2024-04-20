<?php
include('../includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $query = "UPDATE users SET name = '$name', email = '$email', phone_number = '$phone', address = '$address' WHERE user_id = $userId";
    $result = $conn->query($query);
}

mysqli_close($conn);
?>
