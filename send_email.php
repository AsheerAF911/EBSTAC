<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Get and sanitize form data
    $fullname = sanitizeInput($_POST['fullname']);
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $message = sanitizeInput($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Email settings
    $to = "asheeraf007@gmail.com"; // Change to your recipient email
    $subject = "New message from $fullname";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Prepare email body
    $emailBody = "Full Name: $fullname\n";
    $emailBody .= "Email: $email\n";
    $emailBody .= "Phone: $phone\n";
    $emailBody .= "Message: $message\n";

    // Send email
    $mailSent = mail($to, $subject, $emailBody, $headers);

    if ($mailSent) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Invalid request method.";
}
?>
