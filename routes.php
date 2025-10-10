<?php
use Core\Router;

$router = new Router();

$router->add('/', 'controllers/home.php');
$router->add('/admin', 'controllers/admin.php');
$router->add('/login', 'controllers/login.php');
$router->add('/profile', 'controllers/profile.php');
$router->add('/sign_up', 'controllers/sign_up.php');
$router->add('/world_cup', 'controllers/world_cup.php');
$router->dispatch($_SERVER['REQUEST_URI']);
