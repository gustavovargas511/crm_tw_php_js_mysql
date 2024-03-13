<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require 'includes/init.php';

$email   = '';
$subject = '';
$message = '';
$sent    = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email   = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $errors = [];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Please enter a valid email.';
    }

    if ($subject == '') {
        $errors[] = 'Please enter a subject';
    }

    if ($message == '') {
        $errors[] = 'Please write a message';
    }

    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.your_host.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'your_mail@your_mail.com';                     //SMTP username
            $mail->Password   = 'your_password';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('sender@yourmail.com', 'Contact Page!');
            $mail->addAddress('recipient@mail.com');     //Add a recipient
            $mail->addReplyTo($email);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();

            $sent = true;
        } catch (Exception $e) {
            $error[] = $mail->ErrorInfo;
        }
    }
}

?>
<?php require 'includes/header.php' ?>

<h2>Contact</h2>
<?php if ($sent) : ?>
    <p>Message sent!</p>
<?php else : ?>

    <?php if (!empty($errors)) : ?>
        <ul>
            <?php foreach ($errors as $err) : ?>
                <li><?= $err ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <form method="post" id="formContact">
        <div class="form-group mb-3">
            <label for="email">Your email</label>
            <input type="text" class="form-control" name="email" id="email" value="<?= htmlspecialchars($email) ?>">
        </div>

        <div class="form-group mb-4">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" id="subject" value="<?= htmlspecialchars($subject) ?>">
        </div>

        <div class="form-group mb-4">
            <label for="message">Message</label>
            <textarea name="message" class="form-control" id="message" cols="30" rows="10"><?= htmlspecialchars($message) ?></textarea>
        </div>

        <button class="btn btn-primary">Send</button>
    </form>

<?php endif; ?>

<?php require 'includes/footer.php' ?>