<main class="contenedor seccion">
        <h1>Administrador de Clientes</h1>
        <?php include_once __DIR__ . "/../templates/alertas.php" ?>
        <h2><?php echo $nombre; ?></h2>
        <a href="/crear" class="boton-verde">Nuevo Cliente</a>
        <form action="/buscar" method="GET" class="search">
            <input type="text" placeholder="Buscar" id="razon" name="razonsocial">
            <button type="submit">
                <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.91667 0.875C4.92309 0.875 0.875 4.92309 0.875 9.91667C0.875 14.9102 4.92309 18.9583 9.91667 18.9583C11.9476 18.9583 13.8221 18.2887 15.3316 17.1582L20.6284 22.4551C21.1328 22.9595 21.9507 22.9595 22.4551 22.4551C22.9595 21.9507 22.9595 21.1328 22.4551 20.6284L17.1582 15.3316C18.2887 13.8221 18.9583 11.9476 18.9583 9.91667C18.9583 4.92309 14.9102 0.875 9.91667 0.875ZM3.45833 9.91667C3.45833 6.34983 6.34983 3.45833 9.91667 3.45833C13.4835 3.45833 16.375 6.34983 16.375 9.91667C16.375 13.4835 13.4835 16.375 9.91667 16.375C6.34983 16.375 3.45833 13.4835 3.45833 9.91667Z" fill="#6f6f6f"/>
                </svg>
            </button>
        </form>
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