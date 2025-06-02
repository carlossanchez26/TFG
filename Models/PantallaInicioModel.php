<?php
// Models/PantallaInicioModel.php
require_once './Db/Con1Db.php';

class PantallaInicioModel {
    public function obtenerProgresoUsuario($usuarioId) {
        $conexion = Conex1::con1();
        $stmt = $conexion->prepare("
            SELECT MAX(nivel) AS nivel_max
            FROM progreso_usuarios
            WHERE usuario_id = ? AND estado IN ('desbloqueado', 'completado')
        ");
        $stmt->bind_param("i", $usuarioId);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();
        $conexion->close();

        if ($fila = $resultado->fetch_assoc()) {
            return $fila['nivel_max'] ?: 1;
        }
        return 1; // Por defecto desbloqueamos el nivel 1
    }
}
