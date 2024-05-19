<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $to = "thapapuja2018@gmail.com";
    $subject = "Contact Form Submission";
    $body = "Name: $name\n<br>Email: $email\n<br>Message: $message";

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'thapapuja2018@gmail.com';
    $mail->Password = 'daao vszz lgcm ajdm';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($email, $name);
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    if ($mail->send()) {
        echo "success";
    } else {
        http_response_code(500);
        echo "error";
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
?>
