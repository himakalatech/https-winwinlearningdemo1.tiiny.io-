<?php
// WhatsApp number
$whatsappNumber = "9825359393";

// Gathering form data
$fullName = $_POST['full_name']; 
$phone = $_POST['phone'];
$email = $_POST['email'];
$subject = $_POST['subject']; 
$message = $_POST['message'];

// Construct the WhatsApp message
$whatsappMessage = "Name: $fullName\n";
$whatsappMessage .= "Phone: $phone\n";
$whatsappMessage .= "Email: $email\n";
$whatsappMessage .= "Subject: $subject\n";
$whatsappMessage .= "Message: $message";

// Construct the WhatsApp URL
$whatsappURL = "https://wa.me/$whatsappNumber/?text=" . urlencode($whatsappMessage);

// Redirect to WhatsApp
header("Location: $whatsappURL");
exit();
?>