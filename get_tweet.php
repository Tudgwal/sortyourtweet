<?php
function get_tweet($last_id)
{
    require_once('include/TwitterAPIExchange.php');
    $uid = explode('-', $_SESSION['Twitter_settings']['oauth_access_token']);
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    if ($last_id)
        $getfield = '?user_id='. $uid[0] .'&count=2&max_id=' . $last_id;
    else
        $getfield = '?user_id='. $uid[0] .'&count=1';
    $requestMethod = 'GET';

    $twitter = new TwitterAPIExchange($_SESSION['Twitter_settings']);
    $tweet = $twitter->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();
    $tweet = json_decode($tweet);
    if ($last_id)
        return $tweet[1];
    else
        return $tweet[0];
}