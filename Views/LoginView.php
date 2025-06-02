<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio de Sesión</title>
  <link rel="stylesheet" href="./Assets/css/styleLogin.css">
</head>
<body>
  <div class="login-container">
    <form id="form-login">
      <label for="usuario">Nombre de usuario o correo:</label>
      <input type="text" id="usuario" name="usuario" required>

      <label for="contrasena">Contraseña:</label>
      <input type="password" id="contrasena" name="contrasena" required>

      <div id="mensaje-error" class="mensaje-error"></div>

      <button type="submit">Iniciar sesión</button>
    </form>
  </div>

  <script src="./Assets/js/login.js"></script>
</body>
</html>
