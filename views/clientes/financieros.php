<a href="/interfaz" class="boton-verde">Volver</a>

    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
<main class="contenedor-financieros">
    <form class="financieros" action="/descargar?archivo=<?php echo $balance->nombre ?>">
        <h3>Balances</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="balance">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($balances as $balance) { ?>
                <option <?php echo $balance->mes === $balance->nombre ? 'selected' : '' ?> value="<?php echo s($balance->nombre); ?>"><?php echo s($balance->mes); ?>
            <?php  } ?>
        </select>
        <input type="hidden" value="<?php echo $id; ?>">
        <input type="submit" value="Descargar">
    </form>
    <form class="financieros" action="/descargar?archivo=<?php echo $anexo->nombre ?>">
        <h3>Anexos</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="anexo">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($anexos as $anexo) { ?>
                <option <?php echo $anexo->mes === $anexo->nombre ? 'selected' : '' ?> value="<?php echo s($anexo->nombre); ?>"><?php echo s($anexo->mes); ?>
            <?php  } ?>
        </select>
        <input type="submit" value="Descargar">
    </form>
    <form class="financieros" action="/descargar?archivo=<?php echo $resultado->nombre ?>">
        <h3>Estado de Resultados</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="resultado">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($resultados as $resultado) { ?>
                <option <?php echo $resultado->mes === $resultado->nombre ? 'selected' : '' ?> value="<?php echo s($resultado->nombre); ?>"><?php echo s($resultado->mes); ?>
            <?php  } ?>
        </select>
        <input type="submit" value="Descargar">
    </form>
</main>