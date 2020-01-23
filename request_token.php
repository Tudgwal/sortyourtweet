<?php
session_start();
require_once('include/TwitterAPIExchange.php');
$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => $_SESSION['consumer_key'],
    'consumer_secret' => $_SESSION['consumer_secret']
);
$_SESSION['Twitter_settings'] = $settings;
if (substr($_SESSION['url'], -1) == '/')
  $callback_url =  $_SESSION['url'] . 'twitter_callback.php';
else
  $callback_url =  $_SESSION['url'] . '/' .'twitter_callback.php';
$url = 'https://api.twitter.com/oauth/request_token';
$requestMethod = 'POST';
$postfields = array(
    'oauth_callback' => $callback_url
);
$twitter = new TwitterAPIExchange($_SESSION['Twitter_settings']);
$answer =  $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();

$answer = explode('&', $answer);
$oauth_token = substr($answer[0], 12);
header('Location: https://twitter.com/login/error?redirect_after_login=https%3A%2F%2Fapi.twitter.com%2Foauth%2Fauthenticate%3Foauth_token%3D'. $oauth_token);