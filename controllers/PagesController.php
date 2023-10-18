<?php
namespace Controllers;
use MVC\Router;
use Classes\Email;
use Model\Cliente;
use Model\Usuario;
use Model\Clientes;
use Model\Documentos;
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
        $mensaje = null;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];
            if(!$respuestas['nombre']) {
                $alertas['error'][] = 'El nombre es obligatorio';
            }
            if(!$respuestas['mensaje']) {
                $alertas['error'][] = 'El mensaje es obligatorio';
            }
            if(!$respuestas['contacto']) {
                $alertas['error'][] = 'Elige un medio de contacto';
            }
            if($respuestas['contacto'] === 'telefono') {
                if(!$respuestas['telefono']) {
                    $alertas['error'][] = 'El telefono es obligatorio';
                }
                if(!$respuestas['fecha']) {
                    $alertas['error'][] = 'La fecha es obligatoria';
                }
                if(!$respuestas['hora']) {
                    $alertas['error'][] = 'La hora es obligatoria';
                }
            }else if($respuestas['contacto'] === 'correo'){
                if(!$respuestas['correo']) {
                    $alertas['error'][] = 'El correo es obligatorio';
                }
            }
            if(empty($alertas)) {
                $email = new Email($respuestas);
                $email->mensajeContacto();
                $alertas['exito'][] = "Se ha enviado un mensaje con sus datos de contacto, uno de nuestros contadores se pondrá en contacto con usted";
            }
            
        } 
        $router->render('paginas/contacto',[
            'alertas' => $alertas
        ]);
    }
    public static function servicios(Router $router) {
        $router->render('paginas/servicios');
    }
    public static function interfaz(Router $router) {
        $alertas = [];
        $usuario = new Usuario($_SESSION);
        $cliente = Cliente::where('rfc', $usuario->rfc);
        $id = $cliente->id;
        $nombre = $usuario->nombre;
        $rfc = $usuario->rfc;
        $router->render('clientes/interfaz', [
            'alertas' => $alertas,
            'nombre' => $nombre,
            'rfc' => $rfc,
            'id' => $id
        ]);
    }
    public static function descargar() {
        $file = $_GET['nombre'];
        
        $archivo = CARPETA_DOCUMENTOS . $file;

        if (file_exists($archivo)) {
            header('Content-Description: Archivo de descarga');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($archivo) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($archivo));
            readfile($archivo);
            header('Location: /interfaz?');
            exit;
        } else {
            echo "El archivo no existe.";
        }
    }
    public static function financieros(Router $router) {
        $id = $_GET['id'];
        $cliente = Cliente::where('id', $id);
        $balances = Documentos::getArchivos('balance', $id);
        $resultados = Documentos::getArchivos('resultados', $id);
        $anexos = Documentos::getArchivos('anexos', $id);
        
        $router->render('clientes/financieros', [
            'id' => $id,
            'cliente' => $cliente,
            'balances' => $balances,
            'resultados' => $resultados,
            'anexos' => $anexos
        ]);
    }
    public static function sat(Router $router) {
        $id = $_GET['id'];
        $cliente = Cliente::where('id', $id);
        $csf = Documentos::getArchivos('csf', $id);
        $odc = Documentos::getArchivos('odc', $id);
        $declaraciones = Documentos::getArchivos('declaraciones', $id);
        
        $router->render('clientes/sat', [
            'id' => $id,
            'cliente' => $cliente,
            'csf' => $csf,
            'odc' => $odc,
            'declaraciones' => $declaraciones
        ]);
    }
    public static function laboral(Router $router) {
        $id = $_GET['id'];
        $cliente = Cliente::where('id', $id);
        $imss = Documentos::getArchivos('imss', $id);
        $isn = Documentos::getArchivos('isn', $id);
        $nominas = Documentos::getArchivos('nominas', $id);
        $oimss = Documentos::getArchivos('oimss', $id);
        
        $router->render('clientes/laboral', [
            'id' => $id,
            'cliente' => $cliente,
            'imss' => $imss,
            'isn' => $isn,
            'nominas' => $nominas,
            'oimss' => $oimss
        ]);
    }
}
