<?php
session_start();
require 'php/get_data.php';
$data = get_data();
$_SESSION['consumer_key'] = $data['consumer_key'];
$_SESSION['consumer_secret'] = $data['consumer_secret'];
$_SESSION['url'] = $data['url'];
if (empty($_SESSION['Twitter_settings']['oauth_access_token']))
    $_SESSION['Twitter_settings']['oauth_access_token'] = null;

if ($_SESSION['Twitter_settings']['oauth_access_token'] != null){
    echo "
        <a href=\"./sort_tweet.php\">
            <img src=\"pictures/start.png\">
        </a>
    ";
}
else {
    echo "
        <a href=\"request_token.php\">
            <img src=\"pictures/signin.png\">
        </a>
    ";
}
    ?>