<?php
session_start();
require 'get_data.php';
$data = get_data();
var_dump($_SESSION['token']);

$conn = new mysqli($data["dbserver"], $data["dbuser"], $data["dbpassword"], $data["dbname"]);
$sql = "SELECT TOKEN FROM users WHERE TOKEN =  '" . $_SESSION['token'] . "'";
$res = $conn->query($sql);
$res = mysqli_num_rows($res);
if ($res == 0) {
    $sql = "INSERT INTO users (TOKEN) VALUES ('" . $_SESSION['token'] . "')";
    $conn->query($sql);
}
$conn->close();