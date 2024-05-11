<?php
include('./includes/connection.php');

if(isset($_POST['lawyer_id'], $_POST['user_id'], $_POST['date'], $_POST['description'])) {
    $l_id = $_POST['lawyer_id'];
    $u_id = $_POST['user_id'];
    $date = ($_POST['date']);
    $description = $_POST['description'];
    $status = 'pending';

    $query = "INSERT INTO appointments (user_id, lawyer_id, appointment_date, additional_information, status)
    VALUES ('$u_id', '$l_id', '$date', '$description', '$status')";
    $result = $conn->query($query);
}
mysqli_close($conn);
?>
