<h1 class="nombre-pagina">Información</h1>
<p class="descripcion-pagina">Completa tu información llenando el siguiente formulario</p>
<?php include_once __DIR__ . "/../templates/alertas.php" ?>
<form action="/crear-cuenta" method="POST" class="formulario login-form">
<div class="campo">
        <label for="razonsocial">Nombre/Razón Social:</label>
        <input 
            type="text"
            id="razonsocial"
            name="razonsocial"
            placeholder="Tu nombre o Razon Social"
            value="<?php echo $usuario->nombre ?>">
    </div>
    <div class="campo">
        <label for="rfc">RFC:</label>
        <input 
            type="text"
            id="rfc"
            name="rfc"
            placeholder="Tu RFC"
            value="<?php echo $usuario->rfc ?>">
    </div>
    <div class="campo">
        <label for="correo">Email:</label>
        <input 
            type="email"
            id="correo"
            name="correo"
            placeholder="Tu Email"
            value="<?php echo $usuario->correo ?>">
    </div>
    <div class="campo">
        <label for="password">Password:</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Tu password"
            value="<?php echo $usuario->password ?>">
    </div>
    <div class="campo">
        <label for="telefono">RFC:</label>
        <input 
            type="tel"
            id="telefono"
            name="telefono"
            placeholder="Tu telefono"
            value="<?php echo $usuario->telefono ?>">
    </div>
        <input type="submit" value="Enviar" class="boton">
</form>