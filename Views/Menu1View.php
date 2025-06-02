<?php
session_start();
require_once './Models/UsuarioModel.php';

// Verifica que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Traemos sus datos
$modelo = new UsuarioModel();
$usuario = $modelo->obtenerUsuarioPorId($_SESSION['usuario_id']);
$idioma = $usuario['idioma'];
$nombreUsuario = $usuario['nombre_usuario'];

// Ruta de ejemplo de banderas
$banderas = [
    'es' => './Assets/img/banderas/es.png',
    'en' => './Assets/img/banderas/en.png',
    'fr' => './Assets/img/banderas/fr.png'
];

$fotoPerfil = './Assets/img/usuarios/default.jpg'; // puedes cambiar según usuario
?>

<header class="menu-fijo">
    <div class="menu-lateral-icono">&#9776;</div>
    <div class="logo">
        <img src="./Assets/img/logo.png" alt="Logo">
        <span>WordSplash</span>
    </div>
    <div class="usuario-info">
        <img class="bandera" src="<?= $banderas[$idioma] ?>" alt="Bandera">
        <div class="usuario-hud">
            <img class="perfil" src="<?= $fotoPerfil ?>" alt="Perfil">
            <div class="hud-detalles">
                <p><?= htmlspecialchars($nombreUsuario) ?></p>
                <button onclick="editarPerfil()">Editar perfil</button>
            </div>
        </div>
    </div>
</header>
