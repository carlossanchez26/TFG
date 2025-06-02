// Esperamos al envío del formulario
document.getElementById('form-login').addEventListener('submit', async function (e) {
    e.preventDefault(); // Evitamos que se recargue la página

    const usuario = document.getElementById('usuario').value;
    const contrasena = document.getElementById('contrasena').value;

    const formData = new FormData();
    formData.append('usuario', usuario);
    formData.append('contrasena', contrasena);

    const respuesta = await fetch('./Controllers/LoginController.php', {
        method: 'POST',
        body: formData
    });

    const resultado = await respuesta.text();

    const mensaje = document.getElementById('mensaje-error');

    if (resultado.trim() === 'success') {
        // Aquí rediriges a la siguiente pantalla del juego o dashboard
        window.location.href = 'siguientePantalla.php'; // por definir
    } else {
        mensaje.textContent = 'Nombre de usuario/correo y/o contraseña incorrectos.';
        document.getElementById('form-login').reset(); // Borramos campos
    }
});
