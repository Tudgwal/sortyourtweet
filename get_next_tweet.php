<?php
session_start();
require 'php/action_tweet.php';
$tweet_id = $_GET['id'];
$_SESSION['last_tweet'] = $tweet_id;
$sql = "UPDATE users SET LAST_TWEET_ID = '". $tweet_id ."' WHERE TOKEN = '" . $_SESSION['Twitter_settings']['oauth_access_token'] . "'";
$conn = new mysqli($_SESSION['db']['dbserver'], $_SESSION['db']["dbuser"], $_SESSION['db']["dbpassword"], $_SESSION['db']["dbname"]);
$conn->query($sql);
$conn->close();
if ($_GET['validation'] == "delete") {
    destroy_tweet($tweet_id);
}
header('Location: sort_tweet.php');
