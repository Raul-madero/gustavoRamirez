<?php
namespace Model;

class Documentos extends ActiveRecord {
    protected static $tabla = '';
    protected static $columnasDB = ['id', 'mes', 'nombre', 'clienteid'];
    public $id;
    public $mes;
    public $nombre;
    public $clienteid;
    public function __construct($nombre, $clienteid) {
        $this->id = $id ?? null;
        $this->mes = date('m') ?? '';
        $this->nombre = $nombre ?? '';
        $this->clienteid = $clienteid ?? null;
    }
    public function guardarDocumento($tabla) {
        // Insertar en la base de datos
        $query = " INSERT INTO " . $tabla . " (mes, nombre, clienteid) VALUES ('$this->mes', '$this->nombre', '$this->clienteid'); ";
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return $resultado;
    }
}