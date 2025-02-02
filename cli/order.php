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
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) DEFAULT NULL,
 `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `products` text COLLATE utf8mb4_unicode_ci NOT NULL,
 `status` int(11) NOT NULL DEFAULT '1',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
SQL;

if(mysqli_multi_query($link, $sql)){
  echo "\nTable created successfully.\n";
} else{  
    echo "\nERROR: Could not able to execute $sql. " . mysqli_error($link);
}
