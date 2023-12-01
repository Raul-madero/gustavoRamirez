<?php

namespace Model;

class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Errores
    protected static $alertas = [];

    
    // Definir la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;
    }

    // Validación
    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }
    public static function getErrores() {
        return static::$alertas;
    }
    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Registros - CRUD
    public function guardar() {
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }
    public static function getArchivos($tabla, $id) {
        $query = "SELECT * FROM " . $tabla . " WHERE clienteid = $id ";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad . ";";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function resultadoPorPagina() {
        $query = "SELECT count(*) AS conteo FROM " . static::$tabla . ";";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function show($pagina, $limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $pagina . ', ' . $limite . ";";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    public static function findName($name) {
        $query = "SELECT * FROM " . static::$tabla . " " . "WHERE rfc = '$name';";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = $id;";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado );
    }
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE $columna = '$valor';"; 
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado );
    }
    
    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('"; 
        $query .= join("', '", array_values($atributos));
        $query .= "'); ";
        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return $resultado;
    }

    public function actualizar() {

        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ;"; 
        $resultado = self::$db->query($query);
        if($resultado) {
            // Redireccionar al usuario.
            return $resultado;
        }
    }

    // Eliminar un registro
    public function eliminar() {
        // Eliminar el registro
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1;";
        $resultado = self::$db->query($query);
        if($resultado) {
            return $resultado;
        }
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }
    
    protected static function crearObjeto($registro) {
        $objeto = new static;
        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }



    // Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
            }
        }
    }

    // Subida de archivos
    public function setArchivo($archivo) {
        // Elimina la imagen previa
        if( !is_null($this->id) ) {
            $this->borrarArchivo();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($archivo) {
            $this->archivo = $archivo;
        }
    }

    // Elimina el archivo
    public function borrarArchivo() {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_DOCUMENTOS . $this->archivo);
        if($existeArchivo) {
            unlink(CARPETA_DOCUMENTOS . $this->archivo);
        }
    }
}