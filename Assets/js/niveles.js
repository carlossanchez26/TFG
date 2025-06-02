document.addEventListener('DOMContentLoaded', async () => {
    const contenedor = document.getElementById('modo-facil');
    const respuesta = await fetch('./Controllers/NivelController.php');
    const progreso = await respuesta.json();

    const posiciones = [
        { top: 40, left: 100 },
        { top: 140, left: 60 },
        { top: 250, left: 130 },
        { top: 350, left: 90 },
        { top: 450, left: 170 }
    ];

    const indices = [1, 2, 3, 4, 5].sort(() => Math.random() - 0.5);
    const nivelDivs = {};

    indices.forEach((nivel, i) => {
        const estado = progreso[nivel] || 'bloqueado';

        const div = document.createElement('div');
        div.className = `nivel ${estado}`;
        div.textContent = `N${nivel}`;
        div.style.top = posiciones[i].top + "px";
        div.style.left = posiciones[i].left + "px";
        div.dataset.nivel = nivel;

        if (estado !== 'bloqueado') {
            div.setAttribute('tabindex', '0');
            div.setAttribute('role', 'button');
            div.setAttribute('aria-label', `Nivel ${nivel}, estado ${estado}`);
        } else {
            div.setAttribute('aria-label', `Nivel ${nivel} bloqueado`);
        }

        const abrirNivel = () => {
            if (estado === 'bloqueado') {
                alert("Este nivel aún está bloqueado. Se desbloqueará cuando se complete el nivel anterior.");
            } else {
                window.location.href = `preguntas.php?nivel=${nivel}`;
            }
        };

        div.addEventListener('click', abrirNivel);

        // Evento teclado: Enter o Espacio activan el nivel
        div.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                abrirNivel();
            }
        });

        contenedor.appendChild(div);
        nivelDivs[nivel] = div;

        // Crear línea desde anterior si no es el primero
        if (i > 0) {
            const prevPos = posiciones[i - 1];
            const currPos = posiciones[i];

            const linea = document.createElement('div');
            linea.className = 'linea';

            // Calculamos posición
            const left = Math.min(prevPos.left, currPos.left) + 30;
            const top = Math.min(prevPos.top, currPos.top) + 30;
            const width = Math.sqrt(
                Math.pow(currPos.left - prevPos.left, 2) +
                Math.pow(currPos.top - prevPos.top, 2)
            );

            linea.style.width = `${width}px`;
            linea.style.left = `${left}px`;
            linea.style.top = `${top}px`;

            // Rotación
            const angle = Math.atan2(currPos.top - prevPos.top, currPos.left - prevPos.left) * 180 / Math.PI;
            linea.style.transform = `rotate(${angle}deg)`;

            // Activar línea si nivel anterior está completado
            const anteriorNivel = indices[i - 1];
            if (progreso[anteriorNivel] === 'completado') {
                setTimeout(() => {
                    linea.classList.add('activa');
                }, 300);
            }

            contenedor.appendChild(linea);
        }
    });
});
