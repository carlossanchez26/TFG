// Controllers/PantallaInicioController.php
<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require_once './Models/pantallaInicioModel.php';

$model = new PantallaInicioModel();
$progresoUsuario = $model->obtenerProgresoUsuario($_SESSION['usuario_id']);

// Pasamos la variable $progresoUsuario a la vista para usarla
require_once './Views/pantallaInicioView.php';
