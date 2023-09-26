<?php

namespace Model;

class Admin extends ActiveRecord {
    // Base DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'rfc', 'password'];

    public $id;
    public $rfc;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->rfc = $args['rfc'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!$this->rfc) {
            self::$alertas['error'][] = "El RFC del usuario es obligatorio";
        }
        if(!$this->password) {
            self::$alertas['error'][] = "El Password del usuario es obligatorio";
        }
        return self::$alertas;
    }

    public function existeUsuario() {
        // Revisar si el usuario existe.
        $query = "SELECT * FROM usuarios WHERE rfc = '" . $this->rfc . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows) {
            return
                $resultado;
        } else {
            self::$alertas['error'][] = 'El Usuario No Existe';
            return [
                false,
                self::$alertas
            ];
        } 
    }

    public function verificarPassword($resultado) {
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);
        debuguear($autenticado);
        if(!$autenticado) {
            self::$alertas['error'][] = 'Password Incorrecto';
        }else {
            return $autenticado;
        }
    }
    public static function autenticar() {
        session_start();
        $_SESSION['usuario'] = $this->rfc;
        $_SESSION['login'] = true;
        header('Location: /crear');
    }
}
