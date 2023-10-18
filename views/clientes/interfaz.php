<main class="contenedor seccion">
    <h1><?php echo $rfc; ?></h1>
    <?php include_once __DIR__ . "/../templates/alertas.php" ?>
    <h2><?php echo $nombre; ?></h2>
</main>
<section class="card-container__interfaz">
    <div class="cards__interfaz">
        <a href="/financieros?id=<?php echo $id; ?>">
            <div class="card-image__interfaz">
                <img src="./img/financieros.webp" alt="Archivador">
            </div>
            <p>Estados Financieros</p>
        </a>
    </div>
    <div class="cards__interfaz">
        <a href="/sat?id=<?php echo $id; ?>">
            <div class="card-image__interfaz">
                <img src="./img/tax.webp" alt="Archivador">
            </div>
            <p>SAT</p>
        </a>
    </div>
    <div class="cards__interfaz">
        <a href="/laboral?id=<?php echo $id; ?>">
            <div class="card-image__interfaz">
                <img src="./img/work.webp" alt="Archivador">
            </div>
            <p>Laboral</p>
        </a>
    </div>
</section>