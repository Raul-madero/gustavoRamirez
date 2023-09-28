<picture class="picture">
    <img src="./img/logoNegro.svg" alt="">
</picture>
<h1 class="nombre-pagina">Olvidé mi password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu RFC</p>
<?php include_once __DIR__ . "/../templates/alertas.php" ?>
<form action="/olvide" method="POST" class="formulario login-form">
    <div class="campo">
        <label for="rfc">RFC:</label>
        <input 
            type="text"
            id="rfc"
            name="rfc"
            placeholder="Tu RFC">
    </div>
    <input type="submit" value="Enviar Instrucciones" class="boton">
    <div class="acciones">
    <a href="/login">¿Ya tienes una cuenta? Inicia sesión.</a>
</div>
</form>

