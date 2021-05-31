<?php 

require "Router.php";

use App\Core\Router;

$P = Router::param;

Router::get('/', function() {
    print_r("Welcome Home");
});

Router::get("/hello/{$P}/world/{$P}/{$P}", function($param_1, $param_2, $param_3) {
    print_r("Hello {$param_1} World {$param_2} {$param_3}");
});

Router::cleanup();

