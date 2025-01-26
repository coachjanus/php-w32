<?php

/**
 * Attempt MySQL server connection. 
 * Assuming you are running MySQL server 
 * with default setting (user 'root' with no password)
 **/

$host = '127.0.0.1';
$user = 'root';
$password = "[password]";
$database = 'shopaholic';

$link = mysqli_connect(
    $host, 
    $user, 
    $password, 
    $database
);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt create table query execution

$sql = <<<SQL
  DROP TABLE IF EXISTS categories;
  CREATE TABLE categories (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    section_id int(11) NOT NULL,
    cover varchar(255) NOT NULL,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;

if(mysqli_multi_query($link, $sql)){
    echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);

