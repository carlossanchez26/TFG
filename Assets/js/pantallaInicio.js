// Assets/js/pantallaInicio.js
document.addEventListener('DOMContentLoaded', () => {
    const totalNiveles = 15;

    for (let nivel = 1; nivel <= totalNiveles; nivel++) {
        const nivelElement = document.querySelector(`.nivel.nivel${nivel}`);

        if (!nivelElement) continue;

        if (nivel < nivelMaxDesbloqueado) {
            nivelElement.classList.add('completado');
        } else if (nivel === nivelMaxDesbloqueado) {
            nivelElement.classList.add('desbloqueado');
        } else {
            nivelElement.classList.add('bloqueado');
        }

        if (nivel <= nivelMaxDesbloqueado) {
            nivelElement.style.pointerEvents = "auto";
            nivelElement.setAttribute("tabindex", "0");
            nivelElement.setAttribute("aria-disabled", "false");
        } else {
            nivelElement.style.pointerEvents = "none";
            nivelElement.setAttribute("aria-disabled", "true");
        }
    }
});
