<?php
namespace Controllers;
use MVC\Router;
use Model\Cliente;
use Model\Usuario;
use Model\Documentos;
use Model\Colaborador;

class ClientesController {
    public static function buscar() {
        $nombre = $_GET['razonsocial'];
        header("Location: /clientes?name=$nombre");
    }
    public static function index(Router $router) {
        if(isset($_GET['name'])) {
            $cliente = $_GET['name'];
            $clientes = Cliente::findName($cliente);
        }else {
            $totalClientes = count(Cliente::all());
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
        }
        $usuario = new Usuario($_SESSION);
        $nombre = $usuario->nombre;
        
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
                $resultado = $cliente->guardar();
                if($resultado) {
                    header('Location: /clientes?resultado=1');
                }
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
                $resultado = $cliente->guardar();
                if($resultado) {
                    header('Location: /clientes?resultado=2');
                }
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
                $resultado = $cliente->eliminar();
                if($resultado) {
                    header('Location: /clientes?resultado=3');
                }
            }
        }
    }
    public static function documentos(Router $router) {
        $id = $_GET['id'] ?? null;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idcliente = key($_POST);
            if ($_FILES['balance']['tmp_name'] != "") {
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['balance']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('balance');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['anexos']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['anexos']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('anexos');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['csf']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['csf']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('csf');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['declaraciones']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['declaraciones']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('declaraciones');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['imss']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['imss']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('imss');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['isn']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['isn']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('isn');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['nominas']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['nominas']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('nominas');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['odc']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['odc']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('odc');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['oimss']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos();
                debuguear($documento);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['oimss']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('oimss');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
            if ($_FILES['resultados']['tmp_name'] != "") {
                $tabla = key($_FILES);
                $nombreArchivo = md5( uniqid( rand(), true ) ) . ".pdf";
                $documento = new Documentos($nombreArchivo, $idcliente);
                if(!is_dir(CARPETA_DOCUMENTOS)) {
                    mkdir(CARPETA_DOCUMENTOS);
                }
                move_uploaded_file($_FILES['resultados']['tmp_name'], CARPETA_DOCUMENTOS . $nombreArchivo);
                $resultado = $documento->guardarDocumento('resultados');
                if($resultado) {
                    header('Location: /clientes?resultado=4');
                } 
            }
        }
        $alertas = Documentos::getErrores();
        $router->render('admin/documentos', [
            'id' => $id,
            'alertas' => $alertas
        ]);
    }
}