<?php

declare(strict_types=1);

require_once 'AutoLoader.php';

use App\Core\{DotEnv, Kernel};

(new DotEnv(dirname(__DIR__).'/.env'))->load();

$kernel = new Kernel(getenv('APP_ENV'));

if(php_sapi_name() != 'cli') {
    $kernel->run();
}

// var_export($_ENV);
// exit();
