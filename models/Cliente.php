<?php
namespace Model;

class Cliente extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'razonsocial', 'rfc', 'contacto', 'girocomercial', 'idcolaborador'];
    public $id;
    public $razonsocial;
    public $rfc;
    public $contacto;
    public $girocomercial;
    public $idcolaborador;
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->razonsocial = $args['razonsocial'] ?? '';
        $this->rfc = $args['rfc'] ?? '';
        $this->contacto = $args['contacto'] ?? '';
        $this->girocomercial = $args['girocomercial'] ?? '';
        $this->idcolaborador = $args['idcolaborador'] ?? '';
    }
    public function validar() {
        if(!$this->razonsocial) {
            self::$alertas['error'][] = 'La razón social es obligatoria'; 
        }
        if(!$this->rfc) {
            self::$alertas['error'][] = 'El RFC es obligatorio'; 
        }
        if(!$this->contacto) {
            self::$alertas['error'][] = 'La persona de contacto es obligatoria'; 
        }
        if(!$this->girocomercial) {
            self::$alertas['error'][] = 'El giro comercial es obligatorio'; 
        }
        if(!$this->idcolaborador) {
            self::$alertas['error'][] = 'El encargado es obligatorio'; 
        }
        return self::$alertas;
    }
}