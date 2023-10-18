<a href="/interfaz" class="boton boton-verde">Volver</a>

    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
<main class="contenedor-financieros">
    <form class="financieros" action="/descargar?archivo=<?php echo $seguro->nombre ?>">
        <h3>IMSS</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="imss">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($imss as $seguro) { ?>
                <option <?php echo $seguro->mes === $seguro->nombre ? 'selected' : '' ?> value="<?php echo s($seguro->nombre); ?>"><?php echo s($seguro->mes); ?>
            <?php  } ?>
        </select>
        <input type="hidden" value="<?php echo $id; ?>">
        <input type="submit" value="Descargar">
    </form>
    <form class="financieros" action="/descargar?archivo=<?php echo $impuesto->nombre ?>">
        <h3>Impuesto Sobre Nominas</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="opinion">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($isn as $impuesto) { ?>
                <option <?php echo $impuesto->mes === $impuesto->nombre ? 'selected' : '' ?> value="<?php echo s($impuesto->nombre); ?>"><?php echo s($impuesto->mes); ?>
            <?php  } ?>
        </select>
        <input type="submit" value="Descargar">
    </form>
    <form class="financieros" action="/descargar?archivo=<?php echo $nomina->nombre ?>">
        <h3>Nominas</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="resultado">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($nominas as $nomina) { ?>
                <option <?php echo $nomina->mes === $nomina->nombre ? 'selected' : '' ?> value="<?php echo s($nomina->nombre); ?>"><?php echo s($nomina->mes); ?>
            <?php  } ?>
        </select>
        <input type="submit" value="Descargar">
    </form>
    <form class="financieros" action="/descargar?archivo=<?php echo $opinion->nombre ?>">
        <h3>Opinion IMSS</h3>
        <p>Selecciona el mes</p>
        <select name="nombre" id="resultado">
            <option selected value="">-- Seleccione --</option>
            <?php foreach($oimss as $opinion) { ?>
                <option <?php echo $opinion->mes === $opinion->nombre ? 'selected' : '' ?> value="<?php echo s($opinion->nombre); ?>"><?php echo s($opinion->mes); ?>
            <?php  } ?>
        </select>
        <input type="submit" value="Descargar">
    </form>
</main>