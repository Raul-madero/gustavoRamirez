<?php
namespace Controllers;

use MVC\Router;
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
        $usuario = new Usuario;
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id = $_GET['id'] ?? null;
            $usuario = Usuario::find($id);
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            debuguear($usuario);
            $email = new Email($usuario->nombre, $usuario->correo, $usuario->token);
            $email->enviarConfirmacion();
            $resultado = $usuario->guardar();
            if($resultado) {
                header('Location: /mensaje');
            }
        }
        
        $router->render('auth/llenar', [
            'usuario' => $usuario
        ]);
    }
    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }
    public static function confirmar(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no válido');
        }else {
            $usuario->confirmado = '1';
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada');
        }
        $alertas = Usuario::getErrores();
        $router->render('auth/confirmar', [
            'alertas' => $alertas
        ]);
    }
}
