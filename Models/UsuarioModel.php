<?php
require_once './Db/Con1Db.php';

class UsuarioModel {
    // Insertar nuevo usuario
    public function insertarUsuario($nombre, $correo, $contrasena, $idioma) {
        $conexion = Conex1::con1();

        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena, idioma) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $contrasena, $idioma);
        $resultado = $stmt->execute();

        $stmt->close();
        $conexion->close();

        return $resultado;
    }

    // Obtener usuario por ID
    public function obtenerUsuarioPorId($id) {
        $conexion = Conex1::con1();
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    // Verificar credenciales
    public function verificarCredenciales($usuarioOCorreo, $contrasenaIngresada) {
        $conexion = Conex1::con1();
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? OR correo_electronico = ?");
        $stmt->bind_param("ss", $usuarioOCorreo, $usuarioOCorreo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($contrasenaIngresada, $usuario['contrasena'])) {
                return $usuario;
            }
        }
        return false;
    }

    // Obtener ID del usuario por correo o nombre
    public function obtenerIdUsuario($usuarioOCorreo) {
        $conexion = Conex1::con1();
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ? OR correo_electronico = ?");
        $stmt->bind_param("ss", $usuarioOCorreo, $usuarioOCorreo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            return $usuario['id'];
        }

        return false;
    }
}
?>
