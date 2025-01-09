<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize data string
    $data = "";

    // Collect and sanitize form data
    foreach ($_POST as $key => $value) {
        $cleaned_value = htmlspecialchars($value);
        $data .= $key . " - " . $cleaned_value . ", ";
    }
    $data .= "\n"; // Add a new line between each form submission

    // Attempt to write data to the file
    $ret = file_put_contents('./mydata.txt', $data, FILE_APPEND | LOCK_EX);
    if ($ret === false) {
        die('There was an error writing this file');
    } else {
        // HTML response with user-friendly message
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Submission Successful</title>
            <link rel='stylesheet' href='website.css'> <!-- Ensure this path is correct -->
        </head>
        <body>
            <div class='wrapper'>
                <h1>Thank You!</h1>
                <p>Your submission has been recorded.</p>
                <p><a href='index.html'>Go back to the homepage</a></p>
            </div>
        </body>
        </html>";
    }
} else {
    echo "Invalid request method.";
}