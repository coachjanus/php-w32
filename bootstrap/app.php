<?php

declare(strict_types=1);

error_reporting(0);

define('ROOT', dirname(__DIR__));

function uri(): string {
    return trim($_SERVER['REQUEST_URI'], '/');
}

function home() {
    include ROOT.'/app/Controllers/HomeController.php';
}

function about() {
    include ROOT.'/app/Controllers/AboutController.php';
    // echo "<h1>About page</h1>";
}

function contact() {
    include ROOT.'/app/Controllers/ContactController.php';
    // include './contact.php';
}

function error() {
    include ROOT.'/app/Controllers/ErrorController.php';
    // echo "<h1>404: Not found</h1>";
}

function boot() {
    date_default_timezone_set(getenv('APP_TIMEZONE') ? : 'UTC');
}

$_ENV['APP_ENV'] = 'dev';
$_ENV['APP_TIMEZONE'] = 'UTC';


if (getenv('APP_ENV') == 'dev') {
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', '1');
}

boot();


function render($view, $context = []) {

    ob_start();
    $content = load($view, $context);
    require_once dirname(__DIR__)."/views/layouts/app.php";

    echo str_replace("{{ content }}", $content, ob_get_clean());
}

function load($view, $context) {
    $path = dirname(__DIR__)."/views/";
    if(!file_exists($file = $path.$view.".php")) {
        throw new \Exception(sprintf('The file %s could not found.', $file));
    }
    extract($context);
    ob_start();
    include $file;
    return ob_get_clean();
}

$route = match (uri()) {
    '' => home(),
    'about' => about(),
    'contact' => contact(),
    default => error(),
};
