
<form class="formulario login-form" action="/login" method="POST">
    <picture>
        <img src="./img/logoNegro.svg" alt="">
    </picture>
    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
    <div class="campo">
    <label for="usuario">RFC:</label>
    <input 
        type="text"
        id="usuario"
        placeholder="Tu RFC"
        name="rfc">
    </div>
    <div class="campo">
        <label for="password">Password:</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu contraseña"
            name="password">
    </div>
    <input type="submit" class="boton" value="Iniciar Sesión">
    <div class="acciones">
        <a href="/olvide">Olvidé mi contraseña</a>
        <a href="/crear-usuario">Crear usuario</a>
    </div>
</form>
