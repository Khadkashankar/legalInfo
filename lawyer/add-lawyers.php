<?php
include('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];
    $specialization = $_POST['specialization'];
    $description = $_POST['description'];
    $barAssociation = $_POST['barAssociation'];
    $experience = $_POST['experience'];

    $images = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "lawyerimages/" . $_FILES["image"]["name"]);

    $query = "INSERT INTO lawyers (name, email, password, contact_number, location, specialization, description, profile_picture, bar_association_number, experience_years)
              VALUES ('$name', '$email', '$password', '$contact', '$location', '$specialization', '$description', '$images', '$barAssociation', '$experience')";
    $result = $conn->query($query);

    if ($result) {
        echo "<script>alert('Registration successful!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Registration failed!');</script>";
    }
}
mysqli_close($conn);
?>
