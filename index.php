<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with reCAPTCHA and AJAX</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        function submitForm() {
            // Get the reCAPTCHA response
            var recaptchaResponse = grecaptcha.getResponse();
            
            if (recaptchaResponse.length === 0) {
                alert("Please complete the reCAPTCHA.");
                return;  // Prevent form submission
            }

            // Collect form data
            var formData = {
                name: $("#name").val(),
                email: $("#email").val(),
                "g-recaptcha-response": recaptchaResponse
            };

            // Send AJAX request to submit the form data
            $.ajax({
                url: "submit.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    alert(response);  // Handle the server's response
                    grecaptcha.reset();  // Reset reCAPTCHA after submission
                },
                error: function() {
                    alert("An error occurred while submitting the form.");
                }
            });
        }
    </script>
</head>
<body>
    <form id="contactForm" onsubmit="event.preventDefault(); submitForm();">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <!-- Google reCAPTCHA widget -->
        <div class="g-recaptcha" data-sitekey="XXXXXXXXXXX"></div><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
