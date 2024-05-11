<?php
include('../includes/connection.php');

if(isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $userId";
    $result = $conn->query($query);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $output = "<h4>User Details</h4>";
        $output .= "<p>Name: " . $row['name'] . "</p>";
        $output .= "<p>Email: " . $row['email'] . "</p>";
        $output .= "<p>Address: " . $row['address'] . "</p>";
        $output .= "<p>Contact: " . $row['phone_number'] . "</p>";
        $output .= "<p>Gender: " . $row['gender'] . "</p>";
        echo $output;
    }
}
?>
