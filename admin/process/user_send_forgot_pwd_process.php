<?php
// TODO: change the url of the password reset...

require "../../MySQL.php";

use PHPMailer\assets\PHPMailer\Exception;
use PHPMailer\assets\PHPMailer\PHPMailer;

require '../../assets/PHPMailer/Exception.php';
require '../../assets/PHPMailer/PHPMailer.php';
require '../../assets/PHPMailer/SMTP.php';

$email = $_GET["e"];

if (empty($email)) {
    echo "Please enter email address";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Please enter a valid email address";
} else {
    $admin_rs = MySQL::search_prepared("SELECT * FROM `admin` WHERE `email` = ?", [$email], 's');
    if ($admin_rs->num_rows == 1) {
        $unique_id = uniqid("admin_");
        MySQL::iud("UPDATE `admin` SET `verification_code` = ? WHERE `email` = ?", [$unique_id, $email], 'ss');

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->username = 'menukamalinda132@gmail.com'; //SMTP username
            $mail->Password = 'aohflmgpndjchaqr'; //SMTP password
            $mail->SMTPSecure = 'ssl'; //Enable implicit TLS encryption
            $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('menukamalinda132@gmail.com', 'Thiyasara Katalise');
            $mail->addAddress($email);     //Add a recipient
            $mail->addReplyTo('menukamalinda132@gmail.com', 'Thiyasara Katalise');

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'admin Forgot Password';
            $mail->Body = '<center>
        <div style="height:auto;padding:50px 50px 50px 50px;background-color:#edeff1"> <br>
            <h1>Thiyasara Katalise(pvt)ltd.</h1><br>
            <div style="width:500px;height:auto;margin-top:0px;padding-bottom:80px;font-size:14px;background-color:white;text-align:center">
                <br><br>
                <center>
                    <h2>Request for Password Change!</h2><br>
                    <p>If you forgot your password or wish to reset it,<br>use below link to change your password </p><br>
                    <div>
                        <a href="http://localhost/viva-wp/admin_reset_password.php?uid=' . $unique_id . '" style="text-align:center;color:white;text-decoration:none; font-size: 16px; font-weight: bold; background-color:#2ec4b6; padding:15px 20px;" target="_blank">
                            Reset Your Password
                        </a>
                    </div>
                    <br>
                    <p>If you did not request a password reset, you can safely ignore this mail. <br>
                        your password would not change until you create a new password</p>
                </center>
            </div>
        </div>
    </center>';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'success';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "admin not found! Please check your email address.";
    }
}
