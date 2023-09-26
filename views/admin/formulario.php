<fieldset>
    <legend>Informacion Cliente</legend>

    <label for="razon">Razón Social</label>
    <input 
        type="text" 
        placeholder="Razón Social" 
        id="razon" 
        name="razonsocial" 
        value="<?php echo s($cliente->razonsocial); ?>"></input>

    <label for="rfc">RFC:</label>
    <input 
        id="rfc" 
        name="rfc" 
        placeholder="RFC"
        value="<?php echo s($cliente->rfc); ?>"></input>

    <label for="contacto">Contacto:</label>
    <input 
        id="contacto" 
        name="contacto" 
        placeholder="Nombre de Contacto"
        value="<?php echo s($cliente->contacto); ?>"></input>

    <label for="giro">Giro Comercial:</label>
    <input 
        id="giro" 
        name="girocomercial" 
        placeholder="Giro Comercial"
        value="<?php echo s($cliente->girocomercial); ?>"></input>
</fieldset>
<fieldset>
    <legend>Encargado</legend>

    <select name="idcolaborador" id="nombre_vendedor">
        <option selected value="">-- Seleccione --</option>
        <?php foreach($colaboradores as $colaborador) { ?>
            <option <?php echo $cliente->idcolaborador === $colaborador->id ? 'selected' : ''; ?> value="<?php echo s($colaborador->id); ?>"><?php echo s($colaborador->nombre) . " " . s($colaborador->apellido); ?>
        <?php  } ?>
    </select>

</fieldset>