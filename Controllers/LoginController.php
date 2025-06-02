<?php
session_start(); // Iniciamos la sesión para guardar los datos del usuario
require_once './Models/UsuarioModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioOCorreo = $_POST['usuario']; // Puede ser nombre o correo
    $contrasena = $_POST['contrasena'];

    $modeloUsuario = new UsuarioModel();
    $usuario = $modeloUsuario->verificarCredenciales($usuarioOCorreo, $contrasena);

    if ($usuario) {
        // Guardamos en la sesión los datos del usuario
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];

        echo "success"; // En JS comprobamos este mensaje
    } else {
        echo "error"; // Para mostrar mensaje en la interfaz
    }
}
?>
