<?php

// echo "<h1>Home page</h1>";

// echo "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum assumenda molestiae nulla harum soluta dolorum magni laborum tenetur neque dolore commodi, libero quisquam consequatur sapiente adipisci perspiciatis. Fugit, ullam magnam?";
$title = "Welcome to Home page";
render('home/index', compact('title'));
// render('home/index', ['title'=>$title]);
