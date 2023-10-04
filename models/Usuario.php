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
    public function validarInformacionAdicional() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio'; 
        }
        if(!$this->rfc) {
            self::$alertas['error'][] = 'El RFC es obligatorio'; 
        }
        if(!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio'; 
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria'; 
        }
        if(strlen($this->password) < 8) {
            self::$alertas['error'][] = 'La contraseña debe contener al menos 8 caracteres';
        }
        if(!$this->telefono) {
            self::$alertas['error'][] = 'El telefono es obligatorio'; 
        }
        return self::$alertas;
    }
    public function validarRFC() {
        if(!$this->rfc) {
            self::$alertas['error'][] = 'El rfc es obligatorio';
        }
        return self::$alertas;
    }
    public function validarPassword() {
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
            self::$alertas['error'][] = 'El usuario ya existe';
        }
        return $resultado;
    }
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken() {
        $this->token = uniqid();
    }
    public function verificarPassword($password) {
        $resultado = password_verify($password, $this->password);
        if(!$resultado) {
            self::$alertas['error'][] = 'La contraseña no es correcta';
        }else {
            return true;
        }
    }
    public function verificarQueTengaCorreo() {
        $correo = $this->correo;
        if(!$correo) {
            return false;
        }else {
            return true;
        }
    }
    public function estaVerificado() {
        $resultado = $this->verificado;
        if($resultado === '0') {
            return false;
        }else if($resultado === '1'){
            return true;
        }else {
            self::$alertas['error'][] = 'Verifica que tus datos sean correctos';
        }
    }
    public function esAdmin() {
        if($this->admin == 1) {
            return true;
        }else if($this->admin == 0) {
            return false;
        }else {
            self::$alertas['error'][] = 'Verifica tus datos de usuario y vuelve a intentarlo';
        }
    }
}