<?php
session_start();
require_once('include/TwitterAPIExchange.php');
$url = 'https://api.twitter.com/oauth/access_token';
$requestMethod = 'POST';
$postfields = array(
    'oauth_token' => $_GET['oauth_token'],
    'oauth_verifier' => $_GET['oauth_verifier']
);
$twitter = new TwitterAPIExchange($_SESSION['Twitter_settings']);
$result =  $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();

$result = explode('&', $result);
$token = substr($result[0], 12);
$token_secret = substr($result[1], 19);
$_SESSION['Twitter_settings']['oauth_access_token'] = $token;
$_SESSION['Twitter_settings']['oauth_access_token_secret'] = $token_secret;

header('Location: login.php');