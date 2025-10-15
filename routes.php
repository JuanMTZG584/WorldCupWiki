<?php
use Core\Router;

$router = new Router();

$router->add('/', 'controllers/home.php');
//$router->addMiddleware('/', 'middlewares/auth.php');
$router->add('/admin', 'controllers/admin.php');
$router->add('/login', 'controllers/login.php');
//$router->addMiddleware('/login', 'middlewares/auth.php');
$router->add('/profile', 'controllers/profile.php');
$router->add('/sign_up', 'controllers/sign_up.php');
$router->add('/world_cup', 'controllers/world_cup.php');
$router->add('/logout', 'controllers/logout.php');
//APIs routes
$router->add('/api/v1/login', 'APIs/login.api.php');
$router->add('/api/v1/sign_up', 'APIs/sign_up.api.php');
$router->dispatch($_SERVER['REQUEST_URI']);
