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
        $resultado;
        if($_GET['resultado']) {
            $resultado = $_GET['resultado'];
            if($resultado === '1') {
                $alertas['exito'][] = 'El usuario fue creado correctamente'; 
            }
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validar();
            if(empty($alertas)) {
                $usuario = Usuario::where('rfc', $auth->rfc);
                if($usuario) {
                    if($usuario->verificarPassword($auth->password)) {
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['correo'] = $usuario->correo ?? null;
                        $_SESSION['rfc'] = $usuario->rfc;
                        $_SESSION['login'] = true;
                        if(!$_SESSION['correo']) {
                            $id = $usuario->id;
                            header("Location: /crear?id=${id}");
                        }
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
                    debuguear($resultado);
                    if($resultado) {
                        header('Location: /login?resultado=1');
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
    public static function llenar(Router $router) {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'] ?? null;
            $usuario = Usuario::find($id);
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            debuguear($_POST);
            $usuario->sincronizar($_POST);
            $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
        }
        
        $router->render('auth/llenar', [
            'usuario' => $usuario
        ]);
    }
}
