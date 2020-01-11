<?php
session_start();
require "get_data.php";
require_once('include/TwitterAPIExchange.php');
$data = get_data();
$settings = array(
    'oauth_access_token' => "",
    'oauth_access_token_secret' => "",
    'consumer_key' => $data['consumer_key'],
    'consumer_secret' => $data['consumer_secret']
);
$url = 'https://api.twitter.com/oauth/access_token';
$requestMethod = 'POST';
$postfields = array(
    'oauth_token' => $_GET['oauth_token'],
    'oauth_verifier' => $_GET['oauth_verifier']
);
$twitter = new TwitterAPIExchange($settings);
$result =  $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();

$result = explode('&', $result);
$token = substr($result[0], 12);
$token_secret = substr($result[1], 19);
$_SESSION['token'] = $token;
$_SESSION['token_secret'] = $token_secret;
header('Location: ./login.php');