<main class="contenedor seccion">
    <h1>Ingresar Documentos</h1>
    <a href="/clientes" class="boton boton-verde">Volver</a>
    <form class="formulario" action="/crear" method="POST">
        <fieldset>
            <legend>Reportes Financieros</legend>

            <label for="balance">Balance</label>
            <input type="file" id="balance" accept="application/pdf, application/pdf" name="odc">

            <label for="resultados">Estado de Resultados</label>
            <input type="file" id="resultados" accept="application/pdf, application/pdf" name="odc">

            <label for="anexos">Anexos</label>
            <input type="file" id="anexos" accept="application/pdf, application/pdf" name="odc">
        </fieldset>
        <fieldset>
            <legend>SAT</legend>
            <label for="odc">Opinion de Cumplimiento</label>
            <input type="file" id="odc" accept="application/pdf, application/pdf" name="odc">

            <label for="csf">Constancia de Situacion Fiscal</label>
            <input type="file" id="csf" accept="application/pdf, application/pdf" name="csf">

            <label for="declaraciones">Declaraciones</label>
            <input type="file" id="declaraciones" accept="application/pdf, application/pdf" name="declaraciones">

        </fieldset>
        <fieldset>
            <legend>Laboral</legend>
            <label for="nominas">Nominas</label>
            <input type="file" id="nominas" accept="application/pdf, application/pdf" name="nominas">

            <label for="imss">Pago de IMSS</label>
            <input type="file" id="imss" accept="application/pdf, application/pdf" name="imss">

            <label for="isn">Pago 2% Sobre Nominas</label>
            <input type="file" id="isn" accept="application/pdf, application/pdf" name="isn">

            <label for="oimss">Opinion IMSS</label>
            <input type="file" id="oimss" accept="application/pdf, application/pdf" name="oimss">

        </fieldset>
        <fieldset>
            <legend>Otros</legend>
            <label for="otros">Otros</label>
            <input type="file" id="otros" accept="application/pdf, application/pdf" name="otros">

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>