<html>
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
    </html>
<?php

$websites = [
    'relay.php',
];

$maxAttempts = 3; // Number of times to check the status code
$currentAttempt = 0;

do {
    $url = $websites[array_rand($websites)]; // Pick a random URL

    // Increment attempt count
    $currentAttempt++;

    // Get headers and status code
    $headers = @get_headers($url); // Use @ to suppress warnings

    if ($headers === false) {
        // Handle connection failure or invalid URL
        continue; // Retry with next URL
    }

    // Get the HTTP status code from the headers
    $httpStatusCode = substr($headers[0], 9, 3);

    // Check if the status code is in the 4xx or 5xx range
    if (strpos($httpStatusCode, '4') === 0 || strpos($httpStatusCode, '5') === 0) {
        // Handle 4xx or 5xx errors
        continue; // Retry with next URL
    } else {
        // Display the website content
        $website_content = file_get_contents($url);
        echo $website_content;
        exit; // Exit the script after displaying content
    }

    // Sleep for a short time before retrying (optional)
    usleep(500000); // 0.5 seconds (500000 microseconds)

} while ($currentAttempt < $maxAttempts);

// If we reach here, all attempts failed
echo ("Systems Fail");
exit;
?>
