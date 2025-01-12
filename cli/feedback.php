<?php
// cli/init.php

$host = "127.0.0.1";
$user = "root";
$password = "[password]";
$databasse = "shopaholic";

$link = mysqli_connect($host, $user, $password, $databasse);

$sql = "CREATE TABLE feedback (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, first_name VARCHAR(30) NOT NULL, last_name VARCHAR(30) NOT NULL, message TEXT NOT NULL, email VARCHAR(70) NOT NULL UNIQUE, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);";

if(mysqli_query($link, $sql)) {
    echo "Table created successfully";
}else{
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($link);
}
mysqli_close($link);