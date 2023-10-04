<?php 

$db = mysqli_connect(
    $_ENV['BD_HOST'], 
    $_ENV['BD_USER'], 
    $_ENV['BD_PASS'], 
    $_ENV['BD_NAME']);


    
if(!$db) {
    echo "Error no se pudo conectar";
    exit;
}