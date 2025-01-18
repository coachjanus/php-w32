<?php
use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\ContactController;

$router->get('', [HomeController::class, 'index']);
$router->get('about', [AboutController::class, 'index']);
$router->get('contact', [ContactController::class, 'index']);

// return [
//     "" => "HomeController@index",
//     "about" => "AboutController@index",
//     "contact" => "ContactController@index",
//     "error" => "ErrorController",
// ];