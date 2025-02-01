<?php
$host = '127.0.0.1';
$user = 'root';
$password = '[password]';
$database = 'shopaholic';

$link = mysqli_connect(
    $host, 
    $user, 
    $password, 
    $database
);

$sql = <<<SQL
  -- DROP TABLE IF EXISTS users;
  CREATE TABLE users (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    password varchar(100) NOT NULL,
    role_id int(11) unsigned NOT NULL DEFAULT 2,
    first_name varchar(50) NULL,
    last_name varchar(50) NULL,
    phone_number varchar(50) NULL,
    status tinyint(1) unsigned NOT NULL DEFAULT 1,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;

if(mysqli_multi_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
