<picture class="picture">
    <img src="./img/logoNegro.svg" alt="">
</picture>
<?php include_once __DIR__ . "/../templates/alertas.php" ?>
<h1 class="nombre-pagina">Crear nuevo Usuario</h1>
<form class="formulario login-form" action="/crear-usuario" method="POST">
    <div class="campo">
    <label for="usuario">RFC:</label>
    <input 
        type="text"
        id="usuario"
        placeholder="Tu RFC"
        name="rfc"
        value="<?php echo $usuario->rfc ?>">
    </div>
    <div class="campo">
        <label for="password">Password:</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu contraseña"
            name="password">
    </div>
    <div class="campo acciones">
        <div class="esadmin">
            <label for="es-admin">Colaborador</label>
            <input type="radio" value="admin" id="es-admin" name="admin" required>
        </div>
        <div class="esadmin">
            <label for="es-cliente">Cliente</label>
            <input type="radio" value="cliente" id="es-cliente" name="admin" required>
        </div>
    </div>
    <input type="submit" class="boton" value="Crear Usuario">
</form>
<div class="acciones">
    <a href="/login">Iniciar Sesion</a>
</div>