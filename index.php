<?php
// This code is used to redirect the traffic to the processors.
$gourl = [
    'URL1',
    'URL2',
    'URL3',
    'URL4'
];

$url = $gourl[array_rand($gourl)];

$maxAttempts = 3;
$currentAttempt = 0;

do {
    $currentAttempt++;

    $headers = @get_headers($url);
    if ($headers === false) {
        continue;
    }

    $httpStatusCode = substr($headers[0], 9, 3);

    if (strpos($httpStatusCode, '4') === 0 || strpos($httpStatusCode, '5') === 0) {
        continue;
    } else {
        header("Location: $url");
        exit;
    }

    usleep(100000);
} while ($currentAttempt < $maxAttempts);

// All attempts failed, do nothing
exit;
?>
