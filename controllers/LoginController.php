<?php
namespace Controllers;

use MVC\Router;
use Model\Admin;
use Classes\Email;
use Model\Cliente;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $alertas = $auth->validar();
            if(empty($alertas)) {
                $resultado = $auth->existeUsuario();
                if(!$resultado) {
                    $alertas = Admin::getErrores();
                }else {
                    $autenticado = $auth->verificarPassword($resultado);
                    debuguear($autenticado);
                    if($autenticado) {
                        $auth->autenticar();
                    }else {
                        $alertas = Admin::getErrores();
                    }
                }
            }
        }
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }
    public static function logout(Router $router) {
        
    }
    public static function crear(Router $router) {
        $usuario = new Usuario;
        $alertas = [];
        if($_GET['resultado']) {
            if($_GET['resultado'] === '1') {
                $alertas['exito'][] = 'El usuario fue creado correctamente'; 
            }
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar();
            if(empty($alertas)) {
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows) {
                    $alertas = Usuario::getErrores();
                }else {
                    if($usuario->admin == 'admin') {
                        $usuario->admin = 1;
                    }else {
                        $usuario->admin = 0;
                    }
                    $usuario->hashPassword();
                    $usuario->crearToken();
                    $resultado = $usuario->guardar();
                    if($resultado) {
                        echo 'Guardado correctamente';
                    }
                    
                }
            }
        }
        $router->render('auth/crear-usuario', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function olvide(Router $router) {
        
        $router->render('auth/olvide-password');
    }
    public static function recuperar(Router $router) {
        
    }
}
