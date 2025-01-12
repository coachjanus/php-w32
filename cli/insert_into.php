<?php
// cli/insert_into.php

$host = "127.0.0.1";
$user = "root";
$password = "[password]";
$databasse = "shopaholic";

$link = mysqli_connect($host, $user, $password, $databasse);

$sql = 'INSERT INTO feedback (first_name, last_name, email, message) VALUES ("Tom", "Cat", "tomcat@my.cat", "Able an hope of body. Any nay shyness article matters own removal nothing his forming. Gay own additions education satisfied the perpetual. If he cause manor happy. Without farther she exposed saw man led. Along on happy could cease green oh."),("Sara", "Baraboo", "sb@my.cat", "Without farther she exposed saw man led. Along on happy could cease green oh.");';

if(mysqli_query($link, $sql)) {
    echo "Table created successfully";
}else{
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($link);
}
mysqli_close($link);