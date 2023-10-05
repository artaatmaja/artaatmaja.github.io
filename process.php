<?php

    $to = "arta.atmaja@gmail.com";
    $from = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    // Validate email
    if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid sender email.";
        exit;
    }

    // Prevent header injection
    $from = str_replace(array("\r", "\n"), '', $from);
    $name = str_replace(array("\r", "\n"), '', $name);

    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";

    $subject = "You have a message.";

    $body = "Here is what was sent:\r\n";
    $body .= "Name: $name\r\n";
    $body .= "Email: $from\r\n";
    $body .= "Phone: $phone\r\n";
    $body .= "Message: $message\r\n";

    $send = mail($to, $subject, $body, $headers);

    if($send){
        echo "Message sent successfully.";
    } else {
        echo "Message failed to send.";
    }

?>