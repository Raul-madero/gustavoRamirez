
<main class="contenedor seccion-contacto">
    <h1>Contacto</h1>

    <picture>
        <img loading="lazy" src="/img/contacto.webp" alt="Imagen Contacto">
    </picture>

    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
    <h2>Llene el formulario de Contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]">

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]"></textarea>
        </fieldset>

        <fieldset>
            <legend>Forma de contacto</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]">

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto[contacto]">
            </div>
            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton">
    </form>
</main>