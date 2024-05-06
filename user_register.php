<?php
include('./includes/connection.php');

if(isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['address'], $_POST['phone'], $_POST['gender'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $query = "INSERT INTO users (name, email, password, address, phone_number, gender)
    VALUES ('$name', '$email', '$password', '$address', '$phone', '$gender')";
    $result = $conn->query($query);

    if($result) {
        session_start();
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['name'] = $name;
        // Redirect to user dashboard
        header("Location: user-dashboard.php");
        exit();
    } else {
		echo "<script>alert('Invalid username or password');</script>";
        $extra = "index.php";
        echo "<script>window.location.href='" . $extra . "'</script>";
        exit();
    }
}
mysqli_close($conn);
?>
