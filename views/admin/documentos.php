<main class="contenedor seccion">
    <h1>Ingresar Documentos</h1>
    <a href="/clientes" class="boton boton-verde">Volver</a>
    <form class="formulario" action="/crear" method="POST">
        <fieldset>
            <legend>Reportes Financieros</legend>

            <label for="balance">Balance</label>
            <input type="file" id="balance" accept="document/pdf, document/pdf" name="odc">

            <label for="resultados">Estado de Resultados</label>
            <input type="file" id="resultados" accept="document/pdf, document/pdf" name="odc">

            <label for="anexos">Anexos</label>
            <input type="file" id="anexos" accept="document/pdf, document/pdf" name="odc">
        </fieldset>
        <fieldset>
            <legend>SAT</legend>
            <label for="odc">Opinion de Cumplimiento</label>
            <input type="file" id="odc" accept="document/pdf, document/pdf" name="odc">

            <label for="csf">Constancia de Situacion Fiscal</label>
            <input type="file" id="csf" accept="document/pdf, document/pdf" name="csf">

            <label for="declaraciones">Declaraciones</label>
            <input type="file" id="declaraciones" accept="document/pdf, document/pdf" name="declaraciones">

        </fieldset>
        <fieldset>
            <legend>Laboral</legend>
            <label for="nominas">Nominas</label>
            <input type="file" id="nominas" accept="document/pdf, document/pdf" name="nominas">

            <label for="imss">Pago de IMSS</label>
            <input type="file" id="imss" accept="document/pdf, document/pdf" name="imss">

            <label for="isn">Pago 2% Sobre Nominas</label>
            <input type="file" id="isn" accept="document/pdf, document/pdf" name="isn">

        </fieldset>
        <fieldset>
            <legend>Otros</legend>
            <label for="otros">Otros</label>
            <input type="file" id="otros" accept="document/pdf, document/pdf" name="otros">

            <label for="imss">Pago de IMSS</label>
            <input type="file" id="imss" accept="document/pdf, document/pdf" name="imss">

            <label for="isn">Pago 2% Sobre Nominas</label>
            <input type="file" id="isn" accept="document/pdf, document/pdf" name="isn">

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>