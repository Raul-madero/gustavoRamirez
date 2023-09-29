<?php
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\LoginController;
use Controllers\PagesController;
use Controllers\ClientesController;

$router = new Router();
//Iniciar Sesión
$router->get('/usuarios', [LoginController::class, 'login']);
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar Contraseña
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//Crear cuenta
$router->get('/crear-usuario', [LoginController::class, 'crear']);
$router->post('/crear-usuario', [LoginController::class, 'crear']);
$router->get('/llenar', [LoginController::class, 'llenar']);
$router->post('/llenar', [LoginController::class, 'llenar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);

//Paginas
$router->get('/', [PagesController::class, 'index']);
$router->get('/nosotros', [PagesController::class, 'nosotros']);
$router->get('/blog', [PagesController::class, 'blog']);
$router->get('/equipo', [PagesController::class, 'equipo']);
$router->get('/contacto', [PagesController::class, 'contacto']);
$router->post('/contacto', [PagesController::class, 'contacto']);
$router->get('/servicios', [PagesController::class, 'servicios']);
$router->get('/interfaz', [PagesController::class, 'interfaz']);

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
