<?php

namespace Lib;

use Bramus\Router\Router;

$router = new Router();

$router->get('/', '\Lib\Data\Controllers\MemberController@index');
$router->get('/members', '\Lib\Data\Controllers\MemberController@read');

$router->run();