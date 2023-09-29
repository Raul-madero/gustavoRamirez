<?php
namespace Controllers;
use MVC\Router;
use Model\Cliente;
use Model\Colaborador;
class ClientesController {
    public static function index(Router $router) {
        $totalClientes = count(Cliente::all());
        $usuario = new Usuario($_SESSION);
        $nombre = $usuario->nombre;
        $pagina = $_GET['pagina'];
        if(!$pagina || $pagina < 0) {
            $pagina = '0';
        }else if($pagina >= $totalClientes) {
            $pagina = ($totalClientes - 10);
        }else {
            $pagina = $_GET['pagina'];
        }
        $limite = 10;
        $clientes = Cliente::show($pagina, $limite);
        $resultado = $_GET['resultado'] ?? null;
        $alertas = [];
        if($resultado === "1") {
            $alertas['exito'][] = "Creado correctamente";
        }
        if($resultado === "2") {
            $alertas['exito'][] = "Actualizado correctamente";
        }if($resultado === "3") {
            $alertas['exito'][] = "Eliminado correctamente";
        }
        if($resultado === "4") {
            $alertas['exito'][] = "Cargado correctamente";
        }
        $router->render('admin/index', [
            'clientes' => $clientes,
            'resultado' => $resultado,
            'alertas' => $alertas,
            'pagina' => $pagina,
            'nombre'=> $nombre
        ]);
    }
    public static function anterior() {
        $pagina = ($_GET['pagina'] - 10);
        header('Location: /clientes?pagina=' . $pagina);
    }
    public static function siguiente() {
        $pagina = ($_GET['pagina'] + 10);
        header('Location: /clientes?pagina=' . $pagina);
    }
    public static function crear(Router $router) {
        $cliente = new Cliente;
        $alertas = Cliente::getErrores();
        $colaboradores = Colaborador::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente = new Cliente($_POST);
            $alertas = $cliente->validar();
            if(empty($alertas)) {
                $cliente->guardar();
            }
        }
        $router->render('admin/crear', [
            'colaboradores' => $colaboradores,
            'alertas' => $alertas,
            'cliente' => $cliente,
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/clientes');
        $cliente = Cliente::find($id);
        $alertas = Cliente::getErrores();
        $colaboradores = Colaborador::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST;
            $cliente->sincronizar($args);
            $alertas = $cliente->validar();
            if(empty($alertas)) {
                $cliente->guardar();
            }
        }
        $router->render('admin/actualizar', [
            'cliente' => $cliente,
            'alertas' => $alertas,
            'colaboradores' => $colaboradores
        ]);
    }
    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id) {
                $cliente = Cliente::find($id);
                $cliente->eliminar();
            }
        }
    }
    public static function documentos(Router $router) {
        $router->render('admin/documentos');
    }
}