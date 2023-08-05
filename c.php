<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=1">
    <title>Form Submit to Send Email</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/src/Exception.php';

require 'phpmailer/src/PHPMailer.php';

require 'phpmailer/src/SMTP.php';


if (!empty($_POST["send"])) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = "harshilkhatri.sal@gmail.com";
    $mail->Password = "udbjzagwpqcgktrq";

    $userName = $_POST["userName"];
    $userEmail = $_POST["userEmail"];
    $userPhone = $_POST["userPhone"];
    $userMessage = $_POST["userMessage"];
  

    $mail->setFrom($userEmail, $userName);
    $mail->addAddress($userEmail);
    $mail->Subject = "Contact Form Submission";
    $mail->Body = "Thanks, " . $userName .  "\r\n WE got your Message: '" . $userMessage . "'. \r\n We will Contact you soon.";

    if ($mail->send()) {
        $message = "Your contact information has been received successfully.";
    } else {
        $message = "An error occurred while sending the email. Please try again later."; 
    }
}
?>

<div class="form-container">
    <form name="contactFormEmail" method="post">
        <div class="input-row">
            <label>Name <em>*</em></label>
            <input type="text" name="userName" required id="userName">
        </div>
        <div class="input-row">
            <label>Email <em>*</em></label>
            <input type="email" name="userEmail" required id="userEmail">
        </div>
        <div class="input-row">
            <label>Phone <em>*</em></label>
            <input type="text" name="userPhone" required id="userPhone">
        </div>
        <div class="input-row">
            <label>Message <em>*</em></label>
            <textarea name="userMessage" required id="userMessage"></textarea>
        </div>
        <div class="input-row">
            <input type="submit" name="send" value="Submit">
            <?php if (!empty($message)) {?>
                <div class='success'>
                    <strong><?php echo $message; ?></strong>
                </div>
            <?php } ?>
        </div>
    </form>
</div>

</body>
</html>
