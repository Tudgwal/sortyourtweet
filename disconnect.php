<?php
session_start();
$_SESSION['token'] = null;
$_SESSION['token_secret'] = null;
header('Location: ./index.php');
