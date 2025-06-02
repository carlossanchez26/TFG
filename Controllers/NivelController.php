<?php
session_start();
require_once './Models/NivelModel.php';

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['idioma'])) {
    http_response_code(401);
    echo "Sesión no iniciada";
    exit;
}

$usuarioId = $_SESSION['usuario_id'];
$idioma = $_SESSION['idioma'];

$modeloNivel = new NivelModel();
$modeloNivel->inicializarProgreso($usuarioId, $idioma);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json'); // <-- añadido
    $progreso = $modeloNivel->obtenerProgreso($usuarioId, $idioma);
    echo json_encode($progreso);
}
?>

