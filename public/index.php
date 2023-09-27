<?php
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\LoginController;
use Controllers\PagesController;
use Controllers\ClientesController;

$router = new Router();
//Iniciar Sesión
$router->get('/crear-usuario', [LoginController::class, 'crear']);
$router->post('/crear-usuario', [LoginController::class, 'crear']);
$router->get('/usuarios', [LoginController::class, 'login']);
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/crear', [LoginController::class, 'llenar']);
$router->post('/crear', [LoginController::class, 'llenar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/logout', [LoginController::class, 'logout']);

// //Crear cuenta
// $router->get('/crear-cuenta', [LoginController::class, 'crear']);
// $router->post('/crear-cuenta', [LoginController::class, 'crear']);

//Paginas
$router->get('/', [PagesController::class, 'index']);
$router->get('/nosotros', [PagesController::class, 'nosotros']);
$router->get('/blog', [PagesController::class, 'blog']);
$router->get('/equipo', [PagesController::class, 'equipo']);
$router->get('/contacto', [PagesController::class, 'contacto']);
$router->get('/servicios', [PagesController::class, 'servicios']);

//Clientes
$router->get('/clientes', [ClientesController::class, 'index']);
$router->post('/clientes', [ClientesController::class, 'index']);
$router->get('/clientes-siguiente', [ClientesController::class, 'siguiente']);
$router->get('/clientes-anterior', [ClientesController::class, 'anterior']);
$router->get('/actualizar', [ClientesController::class, 'actualizar']);
$router->post('/actualizar', [ClientesController::class, 'actualizar']);
$router->post('/eliminar', [ClientesController::class, 'eliminar']);
$router->get('/documentos', [ClientesController::class, 'documentos']);
$router->post('/documentos', [ClientesController::class, 'documentos']);

//Colaboradores

$router->comprobarRutas();
