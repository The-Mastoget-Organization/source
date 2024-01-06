<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="manifest" href="site.webmanifest">
    <meta name="description" content="Your Feed Retriever for the Mastodon network">
    <meta name="keywords" content="Mastodon, Mastoget">
    <meta name="author" content="The Mastoget Organization">
    <meta property="og:title" content="Mastoget" />
    <meta property="og:type" content="site" />
    <meta property="og:url" content="https://mastoget.x10.bz/" />
    <meta property="og:image" content="https://mastoget.x10.bz/Mastoget_logo.png/" />
    <link rel="canonical" href="https://mastoget.x10.bz/" />
    <title>Mastoget - Your Feed Retriever for the Mastodon network</title>

    <!-- OpenMoji CSS via CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/openmoji@15.0/openmoji.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            margin: 20px;
        }

        .post {
            background-color: #333;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 80%; /* Set the maximum width for the post container to 85% */
            margin-left: auto;
            margin-right: auto;
            color: #fff;
        }
        .post p {
            overflow: hidden;
            white-space: pre-line;
            text-overflow: ellipsis;
                }


        .post a:link {
            color: #fff
        }
        .popup a:link {
            color: #fff
        }

        .post a:hover {
            color: #FF0000
        }

        .media {
            max-width: 100%; /* Set the maximum width for the media container */
            margin-top: 10px;
            overflow: hidden; /* Hide overflow to prevent larger images or videos from extending beyond the container */
        }

        .media img,
        .media video {
            width: 100%; /* Set the width to 100% for responsiveness */
            max-width: 100%; /* Ensure media doesn't exceed its natural size */
            height: auto; /* Maintain the aspect ratio */
            border-radius: 8px;
            display: block; /* Remove any extra spacing */
            margin-bottom: 10px; /* Add some space between media items */
        }

        .author-img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            margin-right: 10px;
        }

        hr {
            border: 0;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: #fff
        }

        @media only screen and (max-width: 600px) {
    .post {
        max-width: 95%; /* Adjust the width for smaller screens */
        margin: 10px;
    }

    .author-img {
        width: 40px;
        height: 40px;
        margin-right: 5px;
    }
        }
    .mastogetlogo
    {
  display: block;
  margin-left: auto;
  margin-right: auto;
    }

    </style>
</head>

<body>
    <img class="mastogetlogo" width="300px" height="120px" src="Mastoget_logo.png">
    <p class="popup" style="color:white; text-align:center"><a href="#" id="popupLink">About Mastoget</a></p><br><br>

    <div id="popupBox" style="display: none; background-color: #333; color: #fff; padding: 50px; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 999;">
    <h1>About Mastoget</h1>
    <p>Mastoget is your feed retriever for the Mastodon network. This amazing site feeds all the public posts posted across the entire Mastodon network to your web browser. </p>
    <p>Atleast for now, Mastoget can only retrieve posts from 5 randomly selected servers at a time, this is to avoid overloading this site's servers as every visitor visit means individual request to these Mastodon servers.</p>
    <p class="popup">
    <a href="https://mastodon.social/@mastoget">Mastodon Profile</a><br>
    <a href="https://github.com/The-Mastoget-Organization/">Github Profile</a><br>
    <a href="https://github.com/The-Mastoget-Organization/source">Source Code</a><br>
    <a href="https://github.com/The-Mastoget-Organization/privacypolicy">Privacy Policy</a><br>
    <a href="https://github.com/The-Mastoget-Organization/termsofservice">Terms of Service</a>
    </p>
    <br><br>
    ©The Mastoget Organization. All Rights Reserved.
    <br>
    <button onclick="closePopup()" style="background-color: #04AA6D; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;  margin: 4px 2px; cursor: pointer;">Okay</button>
    </div>

    <a style="display:none;" rel="me" href="https://mastodon.social/@mastoget">Mastodon</a>

   <script>
    // JavaScript code to show the popup when the link is clicked
    document.getElementById('popupLink').addEventListener('click', function(event) {
        event.preventDefault(); // Prevents the default behavior of the link
        document.getElementById('popupBox').style.display = 'block';
    });

    // JavaScript code to close the popup
    function closePopup() {
        document.getElementById('popupBox').style.display = 'none';
    }
    </script>

    <?php
    // Function to fetch posts from a Mastodon instance public timeline using ActivityPub
    function fetchPostsFromMastodon($url)
    {
        // Make a GET request to fetch posts
        $response = file_get_contents($url);

        // Decode JSON response
        $data = json_decode($response, true);

        // Extract and return posts
        return isset($data) ? $data : [];
    }

    // Function to decode HTML entities, including emoji codes
    function decodeEntities($text)
    {
        return html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    // Function to get the profile image URL of the author
    function getAuthorProfileImage($account)
    {
        return $account['avatar'];
    }

    // Function to calculate the time difference and format it
function getTimeElapsedString($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );

    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . ($diff->$k > 1 ? $v . 's' : $v);
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


// Array of Mastodon instance URLs
$urlselector = [
        'https://newsmast.social/api/v1/timelines/public',
        'https://mastodon.social/api/v1/timelines/public',
        'https://mastodon.online/api/v1/timelines/public',
        'https://mas.to/api/v1/timelines/public',
        'https://universeodon.com/api/v1/timelines/public',
        'https://mastodonapp.uk/api/v1/timelines/public',
        'https://social.vivaldi.net/api/v1/timelines/public',
        'https://mastodon.world/api/v1/timelines/public',
        'https://mastodonapp.uk/api/v1/timelines/public',
        'https://det.social/api/v1/timelines/public',
        'https://c.im/api/v1/timelines/public',
        'https://mstdn.party/api/v1/timelines/public',
        'https://toot.community/api/v1/timelines/public',
        'https://ohai.social/api/v1/timelines/public',
        'https://nerdculture.de/api/v1/timelines/public',
        'https://ieji.de/api/v1/timelines/public',
        'https://toot.io/api/v1/timelines/public',
        'https://masto.nu/api/v1/timelines/public',
        'https://mstdn.plus/api/v1/timelines/public',
        'https://stranger.social/api/v1/timelines/public',
        'https://fairy.id/api/v1/timelines/public',
        'https://cupoftea.social/api/v1/timelines/public',
        'https://mstdn.business/api/v1/timelines/public',
        'https://convo.casa/api/v1/timelines/public',
        'https://wehavecookies.social/api/v1/timelines/public',
        'https://toot.funami.tech/api/v1/timelines/public',
        'https://expressional.social/api/v1/timelines/public',
        'https://mastodon-uk.net/api/v1/timelines/public',
        'https://cr8r.gg/api/v1/timelines/public',
        'https://sakurajima.moe/api/v1/timelines/public',
        'https://mastodon.com.pl/api/v1/timelines/public',
        'https://beekeeping.ninja/api/v1/timelines/public',
        'https://hear-me.social/api/v1/timelines/public',
        'https://birdon.social/api/v1/timelines/public',
        'https://squawk.mytransponder.com/api/v1/timelines/public',
        'https://masto.yttrx.com/api/v1/timelines/public',
        'https://planetearth.social/api/v1/timelines/public',
        'https://fairmove.net/api/v1/timelines/public',
        'https://mstdn.social/api/v1/timelines/public',
        'https://mastodon.world/api/v1/timelines/public',
        'https://mastodon.sdf.org/api/v1/timelines/public',
        'https://mindly.social/api/v1/timelines/public',
        'https://geekdom.social/api/v1/timelines/public',
        'https://theblower.au/api/v1/timelines/public',
        'https://lor.sh/api/v1/timelines/public',
        'https://famichiki.jp/api/v1/timelines/public',
        'https://opalstack.social/api/v1/timelines/public',
        'https://blorbo.social/api/v1/timelines/public',
        'https://fandom.ink/api/v1/timelines/public',
        'https://libretooth.gr/api/v1/timelines/public',
        'https://toot.site/api/v1/timelines/public',
        'https://persiansmastodon.com/api/v1/timelines/public',
        'https://social.bau-ha.us/api/v1/timelines/public',
        'https://is.nota.live/api/v1/timelines/public',
        'https://mstdn.dk/api/v1/timelines/public',
        'https://norcal.social/api/v1/timelines/public',
        'https://mountains.social/api/v1/timelines/public',
        'https://esq.social/api/v1/timelines/public',
        'https://friendsofdesoto.social/api/v1/timelines/public',
        'https://opencoaster.net/api/v1/timelines/public',
        'https://maly.io/api/v1/timelines/public',
        'https://raphus.social/api/v1/timelines/public',
        'https://mastodon.cipherbliss.com/api/v1/timelines/public',
        'https://cultur.social/api/v1/timelines/public',
        'https://x0r.be/api/v1/timelines/public',
        'https://lounge.town/api/v1/timelines/public',
        'https://toots.nu/api/v1/timelines/public',
        'https://mastodon.africa/api/v1/timelines/public',
        'https://cwb.social/api/v1/timelines/public',
        'https://camp.smolnet.org/api/v1/timelines/public',
        'https://paktodon.asia/api/v1/timelines/public',
        'https://growers.social/api/v1/timelines/public',
        'https://mastodon.babb.no/api/v1/timelines/public',
        'https://learningdisability.social/api/v1/timelines/public',
        'https://computerfairi.es/api/v1/timelines/public',
];

$randomIndexes = array_rand($urlselector, 5);

// Create a new array with the selected URLs
$urls = [];
foreach ($randomIndexes as $index) {
    $urls[] = $urlselector[$index];
}


    // Loop through each URL and display posts
    foreach ($urls as $url) {
        $posts = fetchPostsFromMastodon($url);

        // Display posts
        foreach ($posts as $post) {
            echo "<div class='post'>";

            // Display author's profile image
            $authorProfileImage = getAuthorProfileImage($post['account']);
            echo "<img class='author-img' src='{$authorProfileImage}' alt='Author Profile Image'>";

            // Display decoded and converted author and content
            echo "<p style='margin-bottom: 2px;'><strong>{$post['account']['display_name']}</strong><p class='post-time' style='margin-top: 0px;'>Posted&nbsp;" . getTimeElapsedString($post['created_at']) . "</p>";
            echo "<p>" . decodeEntities($post['content']) . "</p>";

            // Display media attachments (images or videos)
            if (isset($post['media_attachments']) && !empty($post['media_attachments'])) {
                foreach ($post['media_attachments'] as $attachment) {
                    if ($attachment['type'] === 'image') {
                        echo "<div class='media'><img src='" . $attachment['url'] . "' alt='Image'></div>";
                    } elseif ($attachment['type'] === 'video') {
                        echo "<div class='media'><video controls><source src='" . $attachment['url'] . "' type='video/mp4'></video></div>";
                    }
                }
            }

            echo "</div><hr>";
        }
    }
    ?>

    <!-- OpenMoji JavaScript via CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/openmoji@15.0/openmoji.min.js"></script>
</body>

</html>
