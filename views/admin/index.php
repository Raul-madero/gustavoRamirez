<main class="contenedor seccion">
        <h1>Administrador de Clientes</h1>
        <?php include_once __DIR__ . "/../templates/alertas.php" ?>
        <h2><?php echo $nombre; ?></h2>
        <a href="/crear" class="boton-verde">Nuevo Cliente</a>

        <h2>Clientes</h2>
        <table class="clientes">
            <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>Nombre Cliente</th>
                    <th>RFC</th>
                    <th>Contacto</th>
                    <th>Giro</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los Resultados -->
            <?php foreach ($clientes as $cliente) : ?>
                <tr class="fila-tabla">
                    <td class="hidden"><?php echo $cliente->id; ?></td>
                    <td><?php echo $cliente->razonsocial; ?></td>
                    <td><?php echo $cliente->rfc; ?></td>
                    <td><?php echo $cliente->contacto; ?></td>
                    <td><?php echo $cliente->girocomercial; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/eliminar">
                            <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo boton-clientes" id="eliminar" value="Eliminar">
                        </form>
                        <a href="/documentos?id=<?php echo s($cliente->id); ?>" class="boton-verde boton-clientes">Subir Documentos</a>
                        <a href="/actualizar?id=<?php echo s($cliente->id); ?>" class="boton-verde boton-clientes">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="contenedor paginador">
            <ul class="flechas">
                <li>
                    <a href="/clientes-anterior?pagina=<?php echo $pagina; ?>?nombre=<?php echo $admin; ?>"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg> Anterior</a>
                </li>
                <li>
                    <a href="/clientes-siguiente?pagina=<?php echo $pagina; ?>?nombre=<?php echo $admin; ?>"> Siguiente <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m321-80-71-71 329-329-329-329 71-71 400 400L321-80Z"/></svg></a>
                </li>
            </ul>
        </div>
    </main>