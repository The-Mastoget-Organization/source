<?php
// This code processes your request to visit Mastoget and ensures that the renderer is up before you are sent.

// BIG CHUNK OF CODE ARE RETRACTED HERE BECAUSE THEY ARE CRITICAL FOR SECURITY 
// THOSE CODE CANNOT BE DISCLOSED BECAUSE IT MAY RISK THE SECURITY OF MASTOGET


// === REDIRECT LOGIC ===
$websites = [
    'https://masget1.vercel.app/',
    'https://masget2.vercel.app/',
    'https://masget3.vercel.app/',
    'https://masget4.vercel.app/',
    'https://masget5.vercel.app/',
    'https://masget6.vercel.app/',
    'https://masget7.vercel.app/',
    'https://masget8.vercel.app/',
    'https://masget9.vercel.app/',
    'https://masget10.vercel.app/',
    'https://masget11.vercel.app/',
    'https://masget12.vercel.app/',
];
shuffle($websites);
$websites[] = 'https://mastoget.vercel.app/fallback';

foreach ($websites as $url) {
    $headers = @get_headers($url, 1);
    if ($headers && preg_match('#HTTP/\d+\.\d+\s+(\d+)#', $headers[0], $matches)) {
        $statusCode = (int)$matches[1];
        if ($statusCode >= 200 && $statusCode < 400) {
            header("Location: $url", true, 302);
            exit;
        }
    }
}

header("Location: https://mastoget.vercel.app/fallback", true, 302);
exit;
?>
