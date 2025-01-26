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
  DROP TABLE IF EXISTS products;
  CREATE TABLE products (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    description text NOT NULL,
    price float unsigned NOT NULL,
    badge_id int(11) unsigned NOT NULL DEFAULT 1,
    category_id int(11) unsigned NOT NULL,
    brand_id int(11) unsigned NOT NULL,
    image varchar(255) NOT NULL,
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
