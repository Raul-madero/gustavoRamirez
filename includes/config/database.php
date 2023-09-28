<?php 
function conectarDB() : mysqli {
$server = 'localhost';
$user = 'root';
$password = 'Epasilla$0406';
$database = 'gustavoRamirez';
    $db = new mysqli($server, $user, $password, $database);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}