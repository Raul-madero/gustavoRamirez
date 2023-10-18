<a href="/interfaz" class="boton boton-verde">Volver</a>

    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
<main class="contenedor-financieros">
    <form class="financieros" action="/descargar?archivo=<?php echo $constancia->nombre ?>">
        <h3>Constancia de Situacion Fiscal</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="constancia">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($csf as $constancia) { ?>
                <option <?php echo $constancia->mes === $constancia->nombre ? 'selected' : '' ?> value="<?php echo s($constancia->nombre); ?>"><?php echo s($constancia->mes); ?>
            <?php  } ?>
        </select>
        <input type="hidden" value="<?php echo $id; ?>">
        <input type="submit" value="Descargar">
    </form>
    <form class="financieros" action="/descargar?archivo=<?php echo $opinion->nombre ?>">
        <h3>Opinion de Cumplimiento</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="opinion">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($odc as $opinion) { ?>
                <option <?php echo $opinion->mes === $opinion->nombre ? 'selected' : '' ?> value="<?php echo s($opinion->nombre); ?>"><?php echo s($opinion->mes); ?>
            <?php  } ?>
        </select>
        <input type="submit" value="Descargar">
    </form>
    <form class="financieros" action="/descargar?archivo=<?php echo $declaracion->nombre ?>">
        <h3>Declaraciones</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="resultado">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($declaraciones as $declaracion) { ?>
                <option <?php echo $declaracion->mes === $declaracion->nombre ? 'selected' : '' ?> value="<?php echo s($declaracion->nombre); ?>"><?php echo s($declaracion->mes); ?>
            <?php  } ?>
        </select>
        <input type="submit" value="Descargar">
    </form>
</main>