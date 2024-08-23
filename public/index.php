<?php
session_start();
require './includes/Auth.php';

// Função para carregar as páginas
function loadPage($page) {
    $file = "./views/{$page}.php";
    require $file;
    // if (file_exists($file)) {
    //     include $file;
    // } else {
    //     include './views/404.php';
    // }
}

// Roteamento
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$routes = [
    '/' => 'home',  // Página inicial
    '/home' => 'home',  // Página inicial
    '/login' => 'login',
    '/activity' => 'dashboard',
    '/dashboard' => 'dashboard',
    '/logout' => 'logout'
];

if (array_key_exists($url, $routes)) {

    loadPage($routes[$url]);
} else {
    loadPage('404');  // Página não encontrada
}
