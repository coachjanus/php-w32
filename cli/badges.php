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

$sql = <<<SQL
  DROP TABLE IF EXISTS badges;
  CREATE TABLE badges (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    title varchar(10) NOT NULL,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;


// if(mysqli_multi_query($link, $sql)){
//     echo "Table created successfully.";
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }

$sql = "INSERT INTO badges (title) Values ('New'), ('Sale'),('Sold')";

if(mysqli_multi_query($link, $sql)) {
    echo "\nInserting successfully\n";
}else{
    echo "\nERROR: Could not able to execute $sql.\n".mysqli_error($link);
}

mysqli_close($link);