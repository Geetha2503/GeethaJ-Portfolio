<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'janapaga@mail.uc.edu';

// Check if the PHP Email Form library exists
$php_email_form_path = '../assets/vendor/php-email-form/php-email-form.php';
if (file_exists($php_email_form_path)) {
    include($php_email_form_path);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Initialize the PHP_Email_Form class
$contact = new PHP_Email_Form;
$contact->ajax = true;

// Set email details
$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Uncomment below code if you want to use SMTP to send emails
/*
$contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
);
*/

// Add message content
$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Send the email and handle the response
try {
    echo $contact->send();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>