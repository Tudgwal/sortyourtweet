<?php
session_start();
require 'php/get_data.php';
$data = get_data();

$_SESSION['db'] = array(
    'dbserver' => $data['dbserver'],
    'dbuser' => $data['dbuser'],
    'dbpassword' => $data['dbpassword'],
    'dbname' => $data['dbname']
);

$conn = new mysqli($data["dbserver"], $data["dbuser"], $data["dbpassword"], $data["dbname"]);
$sql = "SELECT TOKEN FROM users WHERE TOKEN =  '" . $_SESSION['Twitter_settings']['oauth_access_token'] . "'";
$res = $conn->query($sql);
$res = mysqli_num_rows($res);
if ($res == 0) {
    $sql = "INSERT INTO users (TOKEN) VALUES ('" . $_SESSION['Twitter_settings']['oauth_access_token'] . "')";
    $conn->query($sql);
}
$conn->close();
header('Location: index.php');