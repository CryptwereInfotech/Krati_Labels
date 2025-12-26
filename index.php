<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fromEmail = 'info@kratilabelandtechnology.com';
    $toEmail = 'info@kratilabelandtechnology.com';

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subjectInput = $_POST['subject'] ?? '';
    $messageInput = $_POST['message'] ?? '';

    $subject = "Inquiry from website";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: $fromEmail\r\n";
    $headers .= "Reply-To: $email\r\n";

    $message = "
    <html><body>
    <h2>Contact Request</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Subject:</strong> $subjectInput</p>
    <p><strong>Message:</strong><br>$messageInput</p>
    </body></html>
    ";

    if (mail($toEmail, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "Mail failed. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
