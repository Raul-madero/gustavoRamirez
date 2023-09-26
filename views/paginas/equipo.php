<main>
      <section class="heading-equipo">
        <h1 class="titulo-equipo">Nuestro Equipo</h1>
        <div class="info-equipo">
          <h2>Conocenos</h2>
          <P>Somos un equipo especializado con años de experiencia</P>
        </div>
      </section>
      <section class="contenedor equipo-card-container">
        <?php foreach($colaboradores as $colaborador) : ?>
        <div class="equipo-card">
          <img class="equipo-card__image" src="./img/alex.webp" alt="Alejandro">
          <p class="equipo-card__name"><?php echo $colaborador->nombre; ?></p>
          <p class="equipo-card__post"><?php echo $colaborador->apellido; ?></p>
        </div>
        <?php endforeach; ?>
        </section>   
    <a href="/nosotros" class="boton-verde">Volver</a>
    </main>