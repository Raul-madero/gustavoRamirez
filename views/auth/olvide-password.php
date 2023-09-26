<h1 class="nombre-pagina">Olvidé mi password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu RFC</p>
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

