<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once './Views/menu1View.php';
?>

<div class="contenedor-pantalla-inicial">

    <!-- MODO FÁCIL -->
    <section class="modo facil">
      <div class="modo-titulo">MODO FÁCIL</div>
      <div class="niveles">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <div class="nivel nivel<?= $i ?>" aria-label="Nivel <?= $i ?>"><?= $i ?></div>
          <?php if ($i < 5): ?><div class="linea linea<?= $i ?>"></div><?php endif; ?>
        <?php endfor; ?>
      </div>
    </section>

    <!-- MODO MEDIO -->
    <section class="modo medio">
      <div class="modo-titulo">MODO MEDIO</div>
      <div class="niveles">
        <?php for ($i = 6; $i <= 10; $i++): ?>
          <div class="nivel nivel<?= $i ?>" aria-label="Nivel <?= $i ?>"><?= $i ?></div>
          <?php if ($i < 10): ?><div class="linea linea<?= $i ?>"></div><?php endif; ?>
        <?php endfor; ?>
      </div>
    </section>

    <!-- MODO DIFÍCIL -->
    <section class="modo dificil">
      <div class="modo-titulo">MODO DIFÍCIL</div>
      <div class="niveles">
        <?php for ($i = 11; $i <= 15; $i++): ?>
          <div class="nivel nivel<?= $i ?>" aria-label="Nivel <?= $i ?>"><?= $i ?></div>
          <?php if ($i < 15): ?><div class="linea linea<?= $i ?>"></div><?php endif; ?>
        <?php endfor; ?>
      </div>
    </section>

</div>

<script>
  const nivelMaxDesbloqueado = <?= json_encode($progresoUsuario); ?>;
</script>
