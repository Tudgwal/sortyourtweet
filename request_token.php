<?php
require "get_data.php";
require_once('include/TwitterAPIExchange.php');
$data = get_data();
$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => $data['consumer_key'],
    'consumer_secret' => $data['consumer_secret']
);
$callback_url =  "http://" . $_SERVER['SERVER_NAME'] . substr($_SERVER['REQUEST_URI'], 0, -17) . 'twitter_callback.php';
$url = 'https://api.twitter.com/oauth/request_token';
$requestMethod = 'POST';
$postfields = array(
    'oauth_callback' => $callback_url
);
$twitter = new TwitterAPIExchange($settings);
$answer =  $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();

$answer = explode('&', $answer);
$oauth_token = substr($answer[0], 12);

$url = 'https://api.twitter.com/oauth/authenticate';
$getfield = '?oauth_token=' . $oauth_token;
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();
