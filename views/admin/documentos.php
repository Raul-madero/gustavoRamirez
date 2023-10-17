<main class="contenedor seccion">
    <h1>Ingresar Documentos</h1>
    <a href="/clientes" class="boton boton-verde">Volver</a>
    <form class="formulario" action="/documentos" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Reportes Financieros</legend>
            
            <label for="balance">Balance</label>
            <input 
                type="file" 
                id="balance" 
                accept=".pdf, application/pdf" 
                name="balance">

            <label for="resultados">Estado de Resultados</label>
            <input 
                type="file" 
                id="resultados" 
                accept=".pdf, application/pdf" 
                name="resultados">

            <label for="anexos">Anexos</label>
            <input 
                type="file" 
                id="anexos" 
                accept=".pdf, application/pdf" 
                name="anexos">
        </fieldset>
        <fieldset>
            <legend>SAT</legend>
            <label for="odc">Opinion de Cumplimiento</label>
            <input 
                type="file" 
                id="odc" 
                accept=".pdf, application/pdf" 
                name="odc">

            <label for="csf">Constancia de Situacion Fiscal</label>
            <input 
                type="file" 
                id="csf" 
                accept=".pdf, application/pdf" 
                name="csf">

            <label for="declaraciones">Declaraciones</label>
            <input 
                type="file" 
                id="declaraciones" 
                accept=".pdf, application/pdf" 
                name="declaraciones">

        </fieldset>
        <fieldset>
            <legend>Laboral</legend>
            <label for="nominas">Nominas</label>
            <input 
                type="file" 
                id="nominas" 
                accept=".pdf, application/pdf" 
                name="nominas">

            <label for="imss">Pago de IMSS</label>
            <input 
                type="file" 
                id="imss" 
                accept=".pdf, application/pdf" 
                name="imss">

            <label for="isn">Pago 2% Sobre Nominas</label>
            <input 
                type="file" 
                id="isn" 
                accept=".pdf, application/pdf" 
                name="isn">

            <label for="oimss">Opinion IMSS</label>
            <input 
                type="file" 
                id="oimss" 
                accept=".pdf, application/pdf" 
                name="oimss">

        </fieldset>
        <input type="hidden" name="<?php echo $id; ?>">
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>