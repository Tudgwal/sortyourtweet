<?php
session_start();
$_SESSION['token'] = null;
$_SESSION['token_secure'] = null;
header('Location: ./index.php');