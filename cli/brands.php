<?php
// cli/brands.php

$host = "127.0.0.1";
$user = "root";
$password = "[password]";
$databasse = "shopaholic";

$link = mysqli_connect($host, $user, $password, $databasse);

$sql = "CREATE TABLE brands (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
    name VARCHAR(100) NOT NULL, 
    description TEXT NOT NULL
    );";

if(mysqli_query($link, $sql)) {
    echo "\nTable created successfully\n";
}else{
    echo "\nERROR: Could not able to execute $sql.\n".mysqli_error($link);
}

$sql = "INSERT INTO brands (name, description) Values ('Super Cat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus accusantium corrupti neque quos deserunt omnis culpa itaque, aspernatur eaque? Accusamus, dignissimos. Itaque neque blanditiis inventore provident minus laudantium et repellat!'), ('Super Car', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus accusantium corrupti neque quos deserunt omnis culpa itaque, aspernatur eaque? Accusamus, dignissimos. Itaque neque blanditiis inventore provident minus laudantium et repellat!'), ('Angry Cat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus accusantium corrupti neque quos deserunt omnis culpa itaque, aspernatur eaque? Accusamus, dignissimos. Itaque neque blanditiis inventore provident minus laudantium et repellat!'), ('Cute Cat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus accusantium corrupti neque quos deserunt omnis culpa itaque, aspernatur eaque? Accusamus, dignissimos. Itaque neque blanditiis inventore provident minus laudantium et repellat!'), ('Bad Cat', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus accusantium corrupti neque quos deserunt omnis culpa itaque, aspernatur eaque? Accusamus, dignissimos. Itaque neque blanditiis inventore provident minus laudantium et repellat!')";

if(mysqli_query($link, $sql)) {
    echo "\nInserting successfully\n";
}else{
    echo "\nERROR: Could not able to execute $sql.\n".mysqli_error($link);
}

mysqli_close($link);

