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
                            header("Location: /llenar?id=${id}");
                        }else if(!$usuario->verificado) {
                            $alertas['error'][] = 'Por favor verifica tu cuenta';
                        }
                        if($usuario->admin) {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            $nombre = $usuario->nombre;
                            header("Location: /clientes?nombre=${nombre}");
                        }else {
                            header('Location: /interfaz');
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
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarRFC($auth->rfc);
            if(empty($alertas)) {
                $usuario = Usuario::where('rfc', $auth->rfc);
                if(!$usuario || !$usuario->verificado) {
                    Usuario::setAlerta('error', 'La cuenta proporcionada no existe o no esta verificada');
                    $alertas = Usuario::getErrores();
                }else {
                    $usuario->crearToken();
                    debuguear($usuario);
                }
            }
        }
        $router->render('auth/olvide-password', [
            'alertas' => $alertas        
        ]);
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
            $usuario->hashPassword();
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
            $usuario->verificado = '1';
            $usuario->token = null;
            $resultado = $usuario->guardar();
            if($resultado) {
                Usuario::setAlerta('exito', 'Cuenta confirmada');
            }
        }
        $alertas = Usuario::getErrores();
        $router->render('auth/confirmar', [
            'alertas' => $alertas
        ]);
    }
}
