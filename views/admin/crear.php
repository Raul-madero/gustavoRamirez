<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/clientes" class="boton-verde">Volver</a>

    <?php include_once __DIR__ . "/../templates/alertas.php" ?>

    <form class="formulario" enctype="multipart/form-data" method="POST">
            <?php include __DIR__ . '/formulario.php' ?>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>

</main>