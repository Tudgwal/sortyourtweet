<?php
session_start();
require 'php/action_tweet.php';
if (empty($_SESSION['last_tweet']))
    $tweet = get_tweet(null);
else
    $tweet = get_tweet($_SESSION['last_tweet']);
while ($tweet->retweeted == true){
    $tweet = get_tweet($tweet->id);
    $_SESSION['last_tweet'] = $tweet->id;
}
$_SESSION['last_tweet'] = $tweet->id;
?>

<div id="tweet" tweetID="<?php  echo $tweet->id; ?>"></div>

<script sync src="https://platform.twitter.com/widgets.js"></script>
<script>
    window.onload = (function(){
        var tweet = document.getElementById("tweet");
        var id = tweet.getAttribute("tweetID");

        twttr.widgets.createTweet(
            id, tweet,
            {
                conversation : 'all',    // or all
                cards        : 'hidden',  // or visible
                linkColor    : '#cc0000', // default is blue
                theme        : 'light'    // or dark
            })
            .then (function (el) {
                el.contentDocument.querySelector(".footer").style.display = "none";
            });
    });
</script>

<?php
    echo "
        <div>
            <button type=\"button\" onclick=\"window.location.href = 'get_next_tweet.php?validation=accept&id=". $tweet->id ."';\">Valider</button>
            <button type=\"button\" onclick=\"window.location.href = 'get_next_tweet.php?validation=delete&id=". $tweet->id ."';\">Supprimer</button>
        </div>
     ";
?>