document.addEventListener('DOMContentLoaded', () => {
    // ----------------------------
    // CARRUSEL INFINITO DE IDIOMAS
    // ----------------------------
    const carrusel = document.getElementById('carruselIdiomas');
    const flechaIzquierda = document.getElementById('flecha-izquierda');
    const flechaDerecha = document.getElementById('flecha-derecha');
    const anchoItem = 200;

    const itemsOriginales = Array.from(carrusel.children);
    itemsOriginales.forEach(item => {
        const clonFinal = item.cloneNode(true);
        const clonInicio = item.cloneNode(true);
        carrusel.appendChild(clonFinal);
        carrusel.insertBefore(clonInicio, carrusel.firstChild);
    });

    let posicion = itemsOriginales.length;
    carrusel.style.transform = `translateX(-${posicion * anchoItem}px)`;

    function mover(direccion) {
        posicion += direccion;
        carrusel.style.transition = 'transform 0.3s ease';
        carrusel.style.transform = `translateX(-${posicion * anchoItem}px)`;

        carrusel.addEventListener('transitionend', () => {
            carrusel.style.transition = 'none';
            if (posicion <= 0) {
                posicion = itemsOriginales.length;
                carrusel.style.transform = `translateX(-${posicion * anchoItem}px)`;
            }
            if (posicion >= itemsOriginales.length * 2) {
                posicion = itemsOriginales.length;
                carrusel.style.transform = `translateX(-${posicion * anchoItem}px)`;
            }
        }, { once: true });
    }

    flechaIzquierda.addEventListener('click', () => mover(-1));
    flechaDerecha.addEventListener('click', () => mover(1));

    // ----------------------------
    // SELECTOR DE IDIOMA EN CABECERA
    // ----------------------------
    const selectorIdioma = document.querySelector('.selector-idioma');
    const textoIdioma = selectorIdioma.querySelector('.texto-idioma');
    const hudIdiomas = selectorIdioma.querySelector('.hud-idiomas');
    const flecha = textoIdioma.querySelector('.flecha');

    textoIdioma.addEventListener('click', () => {
        hudIdiomas.classList.toggle('activo');
        flecha.classList.toggle('girada');
    });

    // Evento para seleccionar idioma
    hudIdiomas.querySelectorAll('div').forEach(div => {
        div.addEventListener('click', () => {
            const idiomaSeleccionado = div.innerText.trim();
            textoIdioma.innerHTML = `Idioma de la página: ${idiomaSeleccionado} <span class="flecha">⯆</span>`;

            // Aquí podrías lanzar la lógica para cambiar idioma (por cookies, recarga o AJAX)
            console.log(`Idioma seleccionado: ${idiomaSeleccionado}`);

            hudIdiomas.classList.remove('activo');
            flecha.classList.remove('girada');
        });
    });


    // Redirección al formulario
    document.getElementById('botonComienzaAhora').addEventListener('click', () => {
        window.location.href = "formulario.php"; // Cambia esto al nombre correcto del archivo
    });

});
