<?php

class ContactController
{
    public $title;

    public function __construct() {
        // echo $this->title;
    }
    public function index(){
        $this->title =  "Welcome to Contact page";
        render('contact/index', ['title' => $this->title]);
    }
    // render('home/index', compact('title'));
}
// echo '<ul><li><a href="/">Home</a></li><li><a href="/about">About</a></li><li><a href="/contact">Contact</a></li></ul>';

// echo "<h1>Contact page</h1>";

// echo "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum assumenda molestiae nulla harum soluta dolorum magni laborum tenetur neque dolore commodi, libero quisquam consequatur sapiente adipisci perspiciatis. Fugit, ullam magnam?";

// echo date("F j, Y");
// render('contact/index');