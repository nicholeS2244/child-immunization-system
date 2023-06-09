<?php

require_once realpath(__DIR__ . '/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/SMTP.php";
require_once "PHPMailer/src/Exception.php";


function sendEmail($email, $subject, $message)
{
    $email = $_ENV['EMAIL'];
    $pass = $_ENV['PASS'];

    $mail = new PHPMailer(true);

    //Enable SMTP debugging.
    $mail->SMTPDebug = 0; //0 or 2

    //Set PHPMailer to use SMTP.
    $mail->isSMTP();

    //Set SMTP host name
    $mail->Host = "smtp.gmail.com";

    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;

    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ];

    //Provide username and password
    $mail->Username = $email;
    $mail->Password = $pass;

    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";

    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = $email;
    $mail->FromName = "Child Immunization Center";

    $mail->addAddress($email, $name);

    $mail->isHTML(true);
    $mail->Subject = $subject;

    $mail->Body = $message;

    try {
        $mail->send();
        echo "<h2>Email has been sent successfully</h2>";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

?>
