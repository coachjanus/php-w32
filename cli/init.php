<?php
// cli/init.php

$host = "127.0.0.1";
$user = "root";
$password = "[password]";

$link = mysqli_connect($host, $user, $password);

$sql = <<<EOT
    SET NAMES utf8mb4;
    DROP DATABASE IF EXISTS shopaholic;
    DROP SCHEMA IF EXISTS shopaholic;
    CREATE SCHEMA shopaholic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EOT;

if(mysqli_multi_query($link, $sql)){
    echo "Schema created successfully";
}else{
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($link);
}
mysqli_close($link);