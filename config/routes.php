<?php

use App\Controllers\{HomeController, RegisterController, ContactController, AboutController, LoginController, ProfileController, CartController};

use App\Controllers\Admin\{BrandController, CategoryController, SectionController, ProductController, BadgeController, Dashboard};

use App\Controllers\Api\ApiController;

$router->get('', [HomeController::class, 'index']);
$router->get('about', [AboutController::class, 'index']);
$router->get('contact', [ContactController::class, 'index']);

// Dashboard

$router->get('admin', [Dashboard::class, 'index']);

$router->get('admin/brands', [BrandController::class, 'index']);
$router->get('admin/brands/create', [BrandController::class, 'create']);
$router->post('admin/brands/store', [BrandController::class, 'store']);
$router->get('admin/brands/edit/{id}', [BrandController::class, 'edit']);
$router->post('admin/brands/update', [BrandController::class, 'update']);
$router->post('admin/brands/destroy/{id}', [BrandController::class, 'destroy']);




$router->get('admin/categories', [CategoryController::class, 'index']);
$router->get('admin/categories/create', [CategoryController::class, 'create']);
$router->post('admin/categories/store', [CategoryController::class, 'store']);
$router->get('admin/categories/edit/{id}', [CategoryController::class, 'edit']);
$router->post('admin/categories/update', [CategoryController::class, 'update']);
$router->post('admin/categories/destroy/{id}', [CategoryController::class, 'destroy']);


$router->get('admin/sections', [SectionController::class, 'index']);
$router->get('admin/sections/create', [SectionController::class, 'create']);
$router->post('admin/sections/store', [SectionController::class, 'store']);
$router->get('admin/sections/edit/{id}', [SectionController::class, 'edit']);
$router->post('admin/sections/update', [SectionController::class, 'update']);
$router->post('admin/sections/destroy/{id}', [SectionController::class, 'destroy']);



$router->get('admin/products', [ProductController::class, 'index']);
$router->get('admin/products/create', [ProductController::class, 'create']);
$router->post('admin/products/store', [ProductController::class, 'store']);
$router->get('admin/products/edit/{id}', [ProductController::class, 'edit']);
$router->post('admin/products/update', [ProductController::class, 'update']);
$router->post('admin/products/destroy/{id}', [ProductController::class, 'destroy']);



$router->get('admin/badges', [BadgeController::class, 'index']);
$router->get('admin/badges/create', [BadgeController::class, 'create']);
$router->post('admin/badges/store', [BadgeController::class, 'store']);
$router->get('admin/badges/edit/{id}', [BadgeController::class, 'edit']);
$router->post('admin/badges/update', [BadgeController::class, 'update']);
$router->post('admin/badges/destroy/{id}', [BadgeController::class, 'destroy']);



$router->get('register', [RegisterController::class, 'index']);
$router->post('signup', [RegisterController::class, 'signup']);

$router->get('login', [LoginController::class, 'index']);
$router->post('signin', [LoginController::class, 'signin']);
$router->get('profile', [ProfileController::class, 'index']);
$router->get('logout', [LoginController::class, 'logout']);

$router->get('api/products', [ApiController::class, 'getProducts']);

$router->get('cart', [CartController::class, 'index']);
$router->post('api/checkout', [CartController::class, 'checkout']);
$router->get('orders', [CartController::class, 'orders']);
