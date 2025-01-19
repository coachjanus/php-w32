<?php
use App\Controllers\AboutController;
use App\Controllers\Admin\BrandController;
use App\Controllers\HomeController;
use App\Controllers\ContactController;
use App\Controllers\Admin\Dashboard;

$router->get('', [HomeController::class, 'index']);
$router->get('about', [AboutController::class, 'index']);
$router->get('contact', [ContactController::class, 'index']);

// Dashboard

$router->get('admin', [Dashboard::class, 'index']);

$router->get('admin/brands', [BrandController::class, 'index']);