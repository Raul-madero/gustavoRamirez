<?php
namespace Model;
class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'rfc', 'correo', 'password', 'telefono', 'admin', 'verificado', 'token'];
    public $id;
    public $nombre;
    public $rfc;
    public $correo;
    public $password;
    public $telefono;
    public $admin;
    public $verificado;
    public $token;
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->rfc = $args['rfc'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->verificado = $args['verificado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }
    public function validar() {
        if(!$this->rfc) {
            self::$alertas['error'][] = 'El RFC es obligatorio'; 
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria'; 
        }
        if(strlen($this->password) < 8) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 8 caracteres';
        }
        return self::$alertas;
    }
    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE rfc = '" . $this->rfc . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya esta registrado';
        }
        return $resultado;
    }
    public function hashPassword() {
        $this->password = password_hash($this->$passwordRaw, PASSWORD_BCRYPT);
    }
    public function crearToken() {
        $this->token = uniqid();
    }
}