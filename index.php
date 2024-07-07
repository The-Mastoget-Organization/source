<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png.png">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico.ico">
    <link rel="icon" type="image/x-icon" href="favicon.ico.ico">
    <meta name="description" content="Your Feed Retriever for the Mastodon network">
    <meta name="keywords" content="Mastodon, Mastoget">
    <meta name="author" content="The Mastoget Organization">
    <meta property="og:title" content="Mastoget" />
    <meta property="og:type" content="site" />
    <meta property="og:url" content="https://mastoget.x10.bz/" />
    <meta property="og:image" content="Mastogetlogo.jpg.jpg" />
    <link rel="canonical" href="https://mastoget.x10.bz/" />
    <title>Mastoget - Your Feed Retriever for the Mastodon network</title>
    <link rel="preload" as="image" href="Mastogetlogo.jpg.jpg">
    <link rel="manifest" href="site.webmanifest">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .loading {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="loading">
        <img src="Mastogetlogo.jpg.jpg" width="322" height="116">
        <h2>Please Wait....</h2>
        <h3>We're just doing our job to balance the traffic on our decentralized system.</h3>
    
    </div>
</body>
</html>

<?php

$gourl = [
    'processor.php',
];

$url = $gourl[array_rand($gourl)]; // Pick a random URL

$maxAttempts = 2; // Number of times to check the status code
$currentAttempt = 0;

do {
    // Increment attempt count
    $currentAttempt++;

    // Display the "please wait" screen before checking the URL status
    flush(); // Flush the output buffer to immediately display the HTML

    // Get headers and status code
    $headers = get_headers($url);

    // Get the HTTP status code from the headers
    $httpStatusCode = substr($headers[0], 9, 3);

    // Check if the status code is in the 4xx or 5xx range
    if (strpos($httpStatusCode, '4') === 0 || strpos($httpStatusCode, '5') === 0) {
        // Redirect to another page for error
        header("Refresh: 0; URL=emergency.php"); // Redirect after 3 seconds
        exit; // Exit the script after redirect header
    } else {
        // Redirect to the original location
        header("Refresh: 0; URL=$url"); // Redirect after 5 seconds
        exit; // Exit the script after redirect header
    }

    // Sleep for a short time before retrying (optional)
    usleep(100000); // 0.1 seconds (100000 microseconds)

} while ($currentAttempt < $maxAttempts);

// If we reach here, all attempts failed
echo ("Systems Fail");
?>

