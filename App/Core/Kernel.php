<?php
declare(strict_types=1);

namespace App\Core;

use App\Core\Router;
use App\Core\Http\Request;

class Kernel
{
    private Request $request;
    public function __construct(private  $enviroment) {

        error_reporting(0);

        if ($this->enviroment == 'dev') {
            error_reporting(E_ALL & ~E_NOTICE);
            ini_set('display_errors', '1');
        }

        $this->boot();
        $this->request = new Request();

    }

    private function boot() {
        date_default_timezone_set(getenv('APP_TIMEZONE') ? : 'UTC');
    }

    public function run() {
        $router = new Router($this->request);
        require_once dirname(__DIR__, 2)."/config/routes.php";
        $router->resolve();
    }

    public static function projectDir() {
        return dirname(__DIR__, 2);
    }
    
}