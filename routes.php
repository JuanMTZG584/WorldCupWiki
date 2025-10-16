<?php
use Core\Router;

$router = new Router();

$router->add('/', 'controllers/home.php');
$router->addMiddleware('/', 'middlewares/age_auth.middleware.php');
$router->add('/admin', 'controllers/admin.php');
$router->add('/login', 'controllers/login.php');

//$router->addMiddleware('/login', 'middlewares/auth.php');
$router->add('/profile', 'controllers/profile.php');
$router->addMiddleware('/profile', 'middlewares/auth.php');
$router->add('/sign_up', 'controllers/sign_up.php');
$router->add('/world_cup', 'controllers/world_cup.php');
$router->add('/logout', 'controllers/logout.php');
$router->add('/verify_age', 'controllers/age_auth.php');
//APIs routes
$router->add('/api/v1/login', 'APIs/login.api.php');
$router->add('/api/v1/sign_up', 'APIs/sign_up.api.php');
$router->add('/api/v1/profile', 'APIs/see_profile.api.php');
$router->add('/api/v1/update_profile', 'APIs/update_profile.api.php');

$router->dispatch($_SERVER['REQUEST_URI']);
