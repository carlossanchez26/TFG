<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario Paso a Paso</title>
</head>
<body style="background-color: #d9d9d9;">
  <div class="contenedor-formulario">
    <!-- Barra de progreso visual del formulario -->
    <div class="barra-progreso">
      <div class="progreso" id="barra-progreso"></div>
    </div>

    <!-- Formulario con múltiples pasos -->
    <form id="formulario">

      <!-- Paso 1: Nombre -->
      <div class="paso activo">
        <label for="nombre">¿Cómo te quieres llamar o apodar?</label>
        <input type="text" id="nombre" name="nombre" required>
        <!-- Reglas de validación dinámicas -->
        <ul class="reglas" id="reglas-nombre">
          <li class="regla" data-regla="longitud">Máximo 15 caracteres</li>
          <li class="regla" data-regla="mayuscula">Mínimo 1 mayúscula</li>
          <li class="regla" data-regla="minuscula">Mínimo 1 minúscula</li>
          <li class="regla" data-regla="numero">Mínimo 1 número</li>
        </ul>
      </div>

      <!-- Paso 2: Correo electrónico -->
      <div class="paso">
        <label for="correo">¿Cuál será el correo que quieres utilizar?</label>
        <input type="email" id="correo" name="correo" required>
      </div>

      <!-- Paso 3: Contraseña -->
      <div class="paso">
        <label for="clave">Crea una contraseña segura</label>
        <input type="password" id="clave" name="clave" required>
      </div>

      <!-- Paso 3: Descubrimiento -->
      <div class="paso">
        <label for="descubrimiento">¿Cómo has descubierto la aplicación?</label>
        <select id="descubrimiento" name="descubrimiento">
          <option value="">Selecciona una opción</option>
          <option value="instagram">📷 Instagram</option>
          <option value="twitter">🐦 Twitter</option>
          <option value="tiktok">🎵 TikTok</option>
          <option value="familiares">👪 Familiares</option>
          <option value="anuncios">📢 Anuncios</option>
          <option value="otros">🔍 Otros</option>
        </select>
      </div>

      <!-- Paso 4: Razón de uso -->
      <div class="paso">
        <label for="razon">¿Por qué quieres utilizar esta aplicación?</label>
        <select id="razon" name="razon">
          <option value="">Selecciona una opción</option>
          <option value="aprendizaje">📘 Aprendizaje</option>
          <option value="entretenimiento">🎮 Entretenimiento</option>
          <option value="charlar">💬 Charlar con otros</option>
          <option value="viaje">✈️ Prepararme para un viaje</option>
          <option value="estudios">📚 Impulsar mis estudios</option>
          <option value="otros">🔍 Otros</option>
        </select>
      </div>

      <!-- Paso 5: Idioma -->
      <div class="paso">
        <label for="idioma">¿Qué idioma te gustaría aprender?</label>
        <select id="idioma" name="idioma">
          <option value="">Selecciona una opción</option>
          <option value="espanol">🇪🇸 Español</option>
          <option value="ingles">🇬🇧 Inglés</option>
          <option value="italiano">🇮🇹 Italiano</option>
          <option value="chino">🇨🇳 Chino</option>
          <option value="frances">🇫🇷 Francés</option>
        </select>
      </div>

      <!-- Paso 6: Nivel de idioma -->
      <div class="paso">
        <label for="nivel">¿Qué nivel de <span id="idioma-elegido">[idioma]</span> tienes?</label>
        <select id="nivel" name="nivel">
          <option value="">Selecciona una opción</option>
          <option value="bajo">🟢 Bajo</option>
          <option value="intermedio">🟡 Intermedio</option>
          <option value="alto">🔴 Alto</option>
        </select>
      </div>

      <!-- Paso final -->
      <div class="paso mensaje-final">
        <p>¡Perfecto, ahora sí estamos listos para empezar en serio! Vamos a sumergirnos en esto con toda la energía y las ganas de descubrir cosas nuevas.</p>
      </div>

      <!-- Botones de navegación -->
      <div class="botones">
        <button type="button" id="boton-atras">Atrás</button>
        <button type="button" id="boton-siguiente">Siguiente</button>
      </div>
    </form>
  </div>
</body>
</html>
