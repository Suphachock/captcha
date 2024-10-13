<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaSecret = 'XXXXXXXXXXXXXXXXX'; // Replace with your secret key
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify the reCAPTCHA response
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
    $responseData = json_decode($verify);

    if ($responseData->success) {
        // reCAPTCHA was successful
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);

        // Process the form data here (e.g., save to database, send email)
        echo "Form submitted successfully!";
    } else {
        // reCAPTCHA failed
        echo "Please complete the reCAPTCHA verification.";
    }
}
?>
