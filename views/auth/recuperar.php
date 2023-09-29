<picture class="picture">
    <img src="./img/logoNegro.svg" alt="">
</picture>
<h1 class="nombre-pagina">Olvidé mi password</h1>
<p class="descripcion-pagina">Ingresa una nueva contraseña a continuación:</p>
<?php include_once __DIR__ . "/../templates/alertas.php" ?>
<?php if(!$error) : ?>
<form  method="POST" class="formulario login-form">
    <div class="campo">
        <label for="password">Password:</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Tu Contraseña">
    </div>
    <input type="submit" value="Confirmar contraseña" class="boton">
</form>
<div class="acciones">
    <a href="/login">¿Ya tienes una cuenta? Inicia sesión.</a>
</div>
<?php endif; ?>