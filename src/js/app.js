
document.addEventListener('DOMContentLoaded', function() {

    darkMode();
});
const mobileMenu = document.querySelector('.menu-mobile');
const menu = document.querySelector('.mobile-menu')
const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
const contactoDiv = document.querySelector('#contacto');
metodoContacto.forEach(input => input.addEventListener('click', formaDeContacto));
mobileMenu.addEventListener('click', mostrarMenu)
mobileMenu.addEventListener('touchstart', mostrarMenu)
window.addEventListener('resize', ocultarMenu)
function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

    // console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDarkMode.addEventListener('change', function() {
        if(prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}
function mostrarMenu() {
    menu.classList.toggle('hidden')
}
function ocultarMenu() {
    menu.classList.add('hidden')
}
function formaDeContacto(e) {
    if(e['target']['value'] === 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">Número de Teléfono</label>
        <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">
        
        <p>Elija la fecha y la hora para la llamada</p>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `
    }else if(e['target']['value'] === 'email') {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `
    }
}