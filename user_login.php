<?php
session_start();
include('./includes/connection.php');

if(isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        $_SESSION['name'] = $user['name']; // Store user's name in session

        echo 'success'; // Send success response
    } else {
        echo 'error'; // Send error response
    }
}
mysqli_close($conn);
?>
