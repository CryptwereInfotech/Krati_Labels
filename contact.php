<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check request type
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  echo "Method Not Allowed";
  exit;
}

// Validate form fields
if (
  empty($_POST['name']) ||
  empty($_POST['email']) ||
  empty($_POST['subject']) ||
  empty($_POST['message']) ||
  !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
  http_response_code(400);
  echo "Invalid input.";
  exit;
}

// Sanitize inputs
$name = htmlspecialchars(strip_tags($_POST['name']));
$email = htmlspecialchars(strip_tags($_POST['email']));
$subject = htmlspecialchars(strip_tags($_POST['subject']));
$message = nl2br(htmlspecialchars(strip_tags($_POST['message'])));

// Email config
$to = "info@kratilabelandtechnology.com";  // <-- Change to your own email
$emailSubject = "New Inquiry: $subject";

// Email body
$body = "
<html>
<head><title>Contact Form Submission</title></head>
<body>
  <h2>New message from contact form</h2>
  <p><strong>Name:</strong> {$name}</p>
  <p><strong>Email:</strong> <a href='mailto:{$email}'>{$email}</a></p>
  <p><strong>Subject:</strong> {$subject}</p>
  <p><strong>Message:</strong><br>{$message}</p>
</body>
</html>
";

// Headers
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "From: {$email}\r\n";
$headers .= "Reply-To: {$email}\r\n";

// Send email
if (mail($to, $emailSubject, $body, $headers)) {
  http_response_code(200);
  echo "Your message has been sent successfully.";
} else {
  http_response_code(500);
  echo "Failed to send message. Please try again later.";
}
?>
