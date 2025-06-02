// Elementos clave
const pasos = document.querySelectorAll('.paso');
const barra = document.getElementById('barra-progreso');
const botonSiguiente = document.getElementById('boton-siguiente');
const botonAtras = document.getElementById('boton-atras');

let pasoActual = 0;

// Mostrar el paso actual y actualizar la barra de progreso
function mostrarPaso(indice) {
    pasos.forEach((paso, i) => paso.classList.toggle('activo', i === indice));
    barra.style.width = `${(indice + 1) / pasos.length * 100}%`;
    botonAtras.style.display = indice === 0 ? 'none' : 'inline-block';
    botonSiguiente.textContent = (indice === pasos.length - 1) ? 'Finalizar' : 'Siguiente';
    validarPaso();
}

// Ir al siguiente paso
botonSiguiente.addEventListener('click', () => {
    if (pasoActual < pasos.length - 1) {
        pasoActual++;
        mostrarPaso(pasoActual);
    } else {
        const datos = {
            nombre: document.getElementById('nombre').value,
            correo: document.getElementById('correo').value,
            clave: document.getElementById('clave').value,
            descubrimiento: document.getElementById('descubrimiento').value,
            razon: document.getElementById('razon').value,
            idioma: document.getElementById('idioma').value,
            nivel: document.getElementById('nivel').value
        };

        fetch('Controller/UsuarioController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(datos)
        })
            .then(res => res.json())
            .then(respuesta => {
                if (respuesta.success) {
                    alert('¡Registro exitoso!');
                    // Redirigir al login u otra vista si quieres
                    // window.location.href = 'login.php';
                } else {
                    alert('Error al registrar: ' + respuesta.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al enviar el formulario.');
            });

    }
});

// Ir al paso anterior
botonAtras.addEventListener('click', () => {
    if (pasoActual > 0) {
        pasoActual--;
        mostrarPaso(pasoActual);
    }
});

// Validación dinámica del campo "nombre"
document.getElementById('nombre').addEventListener('input', e => {
    const valor = e.target.value;
    document.querySelector('[data-regla="longitud"]').classList.toggle('cumplida', valor.length <= 15);
    document.querySelector('[data-regla="mayuscula"]').classList.toggle('cumplida', /[A-Z]/.test(valor));
    document.querySelector('[data-regla="minuscula"]').classList.toggle('cumplida', /[a-z]/.test(valor));
    document.querySelector('[data-regla="numero"]').classList.toggle('cumplida', /\d/.test(valor));
    validarPaso();
});

// Validar paso actual y habilitar/deshabilitar el botón de siguiente
function validarPaso() {
    const paso = pasos[pasoActual];
    const input = paso.querySelector('input, select');
    const reglas = paso.querySelectorAll('.regla');

    if (reglas.length > 0) {
        const todasCumplidas = Array.from(reglas).every(regla => regla.classList.contains('cumplida'));
        botonSiguiente.disabled = !todasCumplidas;
    } else if (input) {
        botonSiguiente.disabled = !input.value.trim();
    } else {
        botonSiguiente.disabled = false;
    }

    // Actualizar idioma en nivel si corresponde
    if (input && input.id === "idioma") {
        const idioma = input.options[input.selectedIndex].text;
        document.getElementById('idioma-elegido').textContent = idioma;
    }
}

// Inicializar primer paso
mostrarPaso(pasoActual);


