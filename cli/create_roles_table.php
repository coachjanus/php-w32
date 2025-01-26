<?php

$host = '127.0.0.1';
$user = 'root';
$password = 'password';
$database = 'shopaholic';

$link = mysqli_connect(
    $host, 
    $user, 
    $password, 
    $database
);


$sql = <<<SQL
  DROP TABLE IF EXISTS roles;
  CREATE TABLE roles (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;
 
if(mysqli_multi_query($link, $sql)){
    echo "Table created successfully.";
} else{  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);}

