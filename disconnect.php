<?php
session_start();
$_SESSION['Twitter_settings']['oauth_access_token'] = null;
$_SESSION['Twitter_settings']['oauth_access_token_secret'] = null;
$_SESSION['last_tweet'] = null;
header('Location: index.php');