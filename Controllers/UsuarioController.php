<?php
require_once './Models/UsuarioModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validamos campos obligatorios
    if (!empty($data['nombre']) && !empty($data['correo']) && !empty($data['clave']) && !empty($data['idioma'])) {
        $modelo = new UsuarioModel();

        // Hashear la contraseña
        $claveHash = password_hash($data['clave'], PASSWORD_DEFAULT);

        // Insertamos el usuario
        $registroExitoso = $modelo->insertarUsuario($data['nombre'], $data['correo'], $claveHash, $data['idioma']);

        if ($registroExitoso) {
            // Obtenemos el ID recién insertado
            $idUsuario = $modelo->obtenerIdUsuario($data['correo']);

            if ($idUsuario) {
                // Insertamos los 15 niveles en la tabla progreso_usuarios
                require_once './Db/Con1Db.php';
                $conexion = Conex1::con1();
                $stmt = $conexion->prepare("INSERT INTO progreso_usuarios (usuario_id, nivel, estado, modo, idioma) VALUES (?, ?, ?, ?, ?)");

                $modos = ['facil' => 1, 'medio' => 6, 'dificil' => 11];

                foreach ($modos as $modo => $inicio) {
                    for ($i = $inicio; $i < $inicio + 5; $i++) {
                        $estado = ($i === 1) ? 'desbloqueado' : 'bloqueado';
                        $stmt->bind_param("iisss", $idUsuario, $i, $estado, $modo, $data['idioma']);
                        $stmt->execute();
                    }
                }

                $stmt->close();
                $conexion->close();

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al recuperar ID del usuario']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al insertar el usuario']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    }
}
?>
