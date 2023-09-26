<?php
namespace Model;

class Colaborador extends ActiveRecord {
    protected static $tabla = 'colaboradores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'imagen'];
    public $id;
    public $nombre;
    public $apellido;
    public $imagen;
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }
}