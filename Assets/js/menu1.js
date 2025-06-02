document.addEventListener('DOMContentLoaded', () => {
    const avatar = document.querySelector('.avatar');
    const hud = document.querySelector('.hud-usuario');

    if (avatar && hud) {
        avatar.addEventListener('mouseenter', () => {
            hud.style.display = 'block';
        });

        avatar.addEventListener('mouseleave', () => {
            setTimeout(() => {
                if (!hud.matches(':hover')) {
                    hud.style.display = 'none';
                }
            }, 300);
        });

        hud.addEventListener('mouseleave', () => {
            hud.style.display = 'none';
        });
    }

    function editarPerfil() {
        alert("Funcionalidad aún no disponible.");
    }

});
