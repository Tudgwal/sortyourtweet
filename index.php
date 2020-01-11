<?php
session_start();
require 'get_data.php';
$data = get_data();
?>
<html lang="fr">
<body>
    <a href="./request_token.php">
        <img src="pictures/signin.png">
    </a>
</body>