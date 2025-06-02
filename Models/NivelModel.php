<?php
require_once './Db/Con1Db.php';

class NivelModel {
    public function obtenerProgreso($usuarioId, $idioma) {
        $con = Conex1::con1();

        $stmt = $con->prepare("SELECT nivel, estado FROM progreso_usuarios WHERE usuario_id = ? AND idioma = ?");
        $stmt->bind_param("is", $usuarioId, $idioma);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $progreso = [];

        while ($fila = $resultado->fetch_assoc()) {
            $progreso[$fila['nivel']] = $fila['estado'];
        }

        $stmt->close();
        $con->close();

        return $progreso;
    }

    public function inicializarProgreso($usuarioId, $idioma) {
      $con = Conex1::con1();
      
      // Comprobamos si ya hay progreso
      $stmt = $con->prepare("SELECT COUNT(*) FROM progreso_usuarios WHERE usuario_id = ? AND idioma = ?");
      $stmt->bind_param("is", $usuarioId, $idioma);
      $stmt->execute();
      $stmt->bind_result($existe);
      $stmt->fetch();
      $stmt->close();
      
      if ($existe == 0) {
          $stmt = $con->prepare("INSERT INTO progreso_usuarios (usuario_id, nivel, estado, modo, idioma) VALUES (?, ?, ?, ?, ?)");
      
          for ($i = 1; $i <= 15; $i++) {
              $estado = ($i == 1) ? 'desbloqueado' : 'bloqueado';
          
              if ($i <= 5) $modo = 'facil';
              elseif ($i <= 10) $modo = 'medio';
              else $modo = 'dificil';
          
              $stmt->bind_param("iisss", $usuarioId, $i, $estado, $modo, $idioma);
              $stmt->execute();
          }
      
          $stmt->close();
      }

      $con->close();
    }


    public function actualizarProgreso($usuarioId, $nivel, $estado, $idioma) {
        $con = Conex1::con1();
        $stmt = $con->prepare("UPDATE progreso_usuarios SET estado = ? WHERE usuario_id = ? AND nivel = ? AND idioma = ?");
        $stmt->bind_param("siis", $estado, $usuarioId, $nivel, $idioma);
        $stmt->execute();
        $stmt->close();
        $con->close();
    }
}
?>
