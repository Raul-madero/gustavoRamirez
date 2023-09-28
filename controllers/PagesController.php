<?php
namespace Controllers;
use MVC\Router;
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
}
