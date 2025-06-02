<?php
// Archivo: Db/Con1Db.php
// Clase que maneja la conexión con la base de datos

class Conex1
{
    // Método estático que devuelve la conexión mysqli
    public static function con1()
    {
        // Variables para la conexión: servidor, usuario, contraseña y nombre de la base de datos
        $se = "localhost";         // Servidor donde se aloja la base de datos
        $us = "carlos";           // Usuario con permisos para acceder a la base de datos
        $co = "madrid";           // Contraseña del usuario
        $bd = "bd1";              // Nombre de la base de datos

        // Crear una nueva conexión MySQLi usando las variables anteriores
        $mysqli = new mysqli($se, $us, $co, $bd);

        // Verificar si se produjo un error en la conexión
        if ($mysqli->connect_errno)
        {
            // Construir el mensaje de error con información del problema
            $mensaje = "Error de conexión a BD\r\n" . $mysqli->connect_error;
            // Formatear el mensaje si es muy largo (cada 70 caracteres)
            $mensaje = wordwrap($mensaje, 70, "\r\n");
            // Enviar un correo con el error (debes cambiar xxx@xxx.com por tu correo real)
            mail('xxx@xxx.com', 'Error de conexión a BD', $mensaje);
            
            // Detener la ejecución del script para evitar seguir sin conexión
            exit();
        }
        else
        {
            // Si no hay errores, configurar la conexión para usar el conjunto de caracteres UTF-8
            $mysqli->set_charset("utf8");
            // Devolver el objeto mysqli para usarlo en consultas
            return $mysqli;
        }
    }          
}
?>