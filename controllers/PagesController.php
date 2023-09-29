<?php
namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Model\Clientes;
use Model\Colaborador;

class PagesController {
    public static function index(Router $router) {
        $router->render('paginas/index');
    }
    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros');
    }
    public static function blog(Router $router) {
        $router->render('paginas/blog');
    }
    public static function equipo(Router $router) {
        $colaboradores = Colaborador::all();
        $router->render('paginas/equipo', [
            'colaboradores' => $colaboradores
        ]);
    }
    public static function contacto(Router $router) {
        $router->render('paginas/contacto');
    }
    public static function servicios(Router $router) {
        $router->render('paginas/servicios');
    }
    public static function interfaz(Router $router) {
        $alertas = [];
        $usuario = new Usuario($_SESSION);
        $nombre = $usuario->nombre;
        $rfc = $usuario->rfc;
        // debuguear($usuario);
        $router->render('clientes/interfaz', [
            'alertas' => $alertas,
            'nombre' => $nombre,
            'rfc' => $rfc
        ]);
    }
}
