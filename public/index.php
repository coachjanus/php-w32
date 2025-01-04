Hello PHP

<h2>Hello world</h2>

<ul>
    <li><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/contact">Contact</a></li>
</ul>

<?php

error_reporting(E_ALL & ~E_NOTICE);

// comment

echo "Hello my site";
echo ("Hello my site");

// [a-zA-Z] [0-9] $ # & @ _
$name = "Customer";

echo "Hello $name";

// + - / * && || 

echo 5 + 5;

print("Hello print");

$v = 3.14;
echo gettype($v);
settype($v, "int");

echo gettype($v);
echo $v;

$a = array(1, 2, [3,4,5]);

echo $a;

var_dump($a);
var_export($a);
print_r($a);

define('PI', 3.14);
var_export(PI);

echo __DIR__;
echo __FILE__;
echo __LINE__;

function foo($a): float|int {
    return 55 + $a;
}
$msg = foo(55);
echo $msg;

function fun() {
    $a = 10;
    echo $a;
}

fun();
echo $a;


$x = 2;
$y = 3;

function bar() {
    global $x, $y;
    return $x + $y;
}

$b = bar();
echo $b;

// $GLOBALS
echo $GLOBALS['x'];

function add() {
    static $n = 0;
    $n++;
    return $n;
}

echo add();
echo add();
echo add();
echo add();

$hell = function($name) {
    echo "<h3>Hello $name</h3>";
};
$hell("Tom");

$fn = fn($x, $y) => $x + $y;

echo $fn(4,5);

$g = 1;
$l = 2;

if ($g > $l) {
    echo "It's false";
} else {
    echo "It's true";
}

echo $_SERVER['HTTP_HOST'];

echo $_SERVER['REQUEST_METHOD'];

echo $_SERVER['REQUEST_URI'];

$route = $_SERVER['REQUEST_URI'];

switch ($route) {
    case '/':
        echo "<h1>Home page</h1>";
        break;
    case '/about':
        echo "<h1>About page</h1>";
        break;
    case '/contract':
        include './contact.php';
        break;
}