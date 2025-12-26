<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fromEmail = 'info@kratilabelandtechnology.com';
    $toEmail = 'info@kratilabelandtechnology.com';

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subjectInput = $_POST['subject'] ?? '';
    $messageInput = $_POST['message'] ?? '';

    $subject = "Inquiry from website";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: $fromEmail\r\n";
    $headers .= "Reply-To: $email\r\n";

    $message = "
    <html><body>
    <h2>Quote Request</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Service:</strong> $subjectInput</p>
    <p><strong>Message:</strong><br>$messageInput</p>
    </body></html>
    ";

    // Debug: Save the email content to check
    file_put_contents('debug_log.txt', $message);

    // Test if mail() works
    if (mail($toEmail, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "error - mail function failed";
    }
} else {
    echo "error - not post request";
}
