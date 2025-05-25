// Script para el toggle del menú principal
document.getElementById("menuToggle").addEventListener("click", function () {
  document.getElementById("sidebar").classList.toggle("active");
  document.querySelector(".overlay")?.classList.toggle("active");
});

// Script de validación para formulario CTA
document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("ctaForm");

  form.addEventListener("submit", function (e) {
    // Seleccionar campos y contenedores de error
    const nameInput = form.querySelector("input[type='text']");
    const emailInput = form.querySelector("input[type='email']");
    const messageInput = form.querySelector("textarea");

    const errorName = document.getElementById("error-name");
    const errorEmail = document.getElementById("error-email");
    const errorMessage = document.getElementById("error-message");

    // Limpiar mensajes de error previos y quitar clases
    errorName.textContent = "";
    errorEmail.textContent = "";
    errorMessage.textContent = "";
    nameInput.classList.remove("input-error");
    emailInput.classList.remove("input-error");
    messageInput.classList.remove("input-error");

    let hasErrors = false;

    // Validación del campo Nombre
    if (nameInput.value.trim() === "") {
      errorName.textContent = "El campo Nombre es obligatorio.";
      nameInput.classList.add("input-error");
      hasErrors = true;
    }

    // Validación del campo Correo Electrónico
    if (emailInput.value.trim() === "") {
      errorEmail.textContent = "El campo Correo Electrónico es obligatorio.";
      emailInput.classList.add("input-error");
      hasErrors = true;
    } else {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(emailInput.value.trim())) {
        errorEmail.textContent = "El correo electrónico no es válido.";
        emailInput.classList.add("input-error");
        hasErrors = true;
      }
    }

    // Validación del campo Descripción
    if (messageInput.value.trim() === "") {
      errorMessage.textContent = "El campo Descripción es obligatorio.";
      messageInput.classList.add("input-error");
      hasErrors = true;
    }

    if (hasErrors) {
      e.preventDefault(); // Evitar el envío del formulario
    }
  });
});

// Script para partículas flotantes
document.addEventListener("DOMContentLoaded", function () {
  const particlesContainer = document.getElementById("footerParticles");
  const particleCount = 20;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement("div");
    particle.classList.add("footer-particle");

    // Tamaño aleatorio entre 1px y 3px
    const size = Math.random() * 2 + 1;
    particle.style.width = `${size}px`;
    particle.style.height = `${size}px`;

    // Posición inicial aleatoria
    particle.style.left = `${Math.random() * 100}%`;
    particle.style.bottom = `-10px`;

    // Duración de animación aleatoria entre 10s y 20s
    const duration = Math.random() * 10 + 10;
    particle.style.animationDuration = `${duration}s`;

    // Retraso inicial aleatorio
    particle.style.animationDelay = `${Math.random() * 5}s`;

    particlesContainer.appendChild(particle);
  }
});

// Script para mostrar/ocultar formularios de respuesta

function toggleReplyForm(commentId) {
  const form = document.getElementById("replyForm-" + commentId);
  form.style.display = form.style.display === "block" ? "none" : "block";
}

// Script para mostrar/ocultar el overlay de video

document.addEventListener("DOMContentLoaded", function () {
  const overlay = document.getElementById("video-overlay");
  const content = document.getElementById("video-overlay-content");

  document.body.addEventListener("click", function (e) {
    // 1) Abrir si clicas en un elemento data-video
    const trigger = e.target.closest("[data-video]");
    if (trigger) {
      e.preventDefault();
      let embed = trigger.getAttribute("data-video");
      try {
        embed = JSON.parse(embed);
      } catch (_) {}
      content.innerHTML = embed;
      overlay.classList.add("active");
      return;
    }
    // 2) Cerrar si overlay está activo y clicas fuera del inner
    if (
      overlay.classList.contains("active") &&
      !e.target.closest("#video-overlay-inner")
    ) {
      overlay.classList.remove("active");
      content.innerHTML = "";
    }
  });
});

// ############################################
// JavaScript mejorado para filtro de proyectos
// ############################################

document.addEventListener("DOMContentLoaded", () => {
  // Solo ejecutar en la página de proyectos (archive.php) si existe el formulario
  const filtro = document.querySelector(".proyectos-filtro");
  if (!filtro) return;

  // Crear hamburguesa
  const hamburger = document.createElement("button");
  hamburger.className = "filter-hamburger";
  hamburger.setAttribute("aria-label", "Abrir filtros");
  hamburger.setAttribute("aria-expanded", "false");
  hamburger.innerHTML = `
    <div class="hamburger-line"></div>
    <div class="hamburger-line"></div>
    <div class="hamburger-line"></div>
  `;

  const overlay = document.createElement("div");
  overlay.className = "filter-overlay";

  // Insertar elementos
  document.body.prepend(hamburger);
  document.body.append(overlay);

  // Función toggle
  const toggleMenu = (state) => {
    const isOpen = state ?? !filtro.classList.contains("active");

    hamburger.classList.toggle("active", isOpen);
    filtro.classList.toggle("active", isOpen);
    overlay.classList.toggle("active", isOpen);
    hamburger.setAttribute("aria-expanded", isOpen.toString());

    document.documentElement.style.overflow = isOpen ? "hidden" : "";
  };

  // Eventos
  hamburger.addEventListener("click", () => toggleMenu());
  overlay.addEventListener("click", () => toggleMenu(false));

  // Cerrar con ESC
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") toggleMenu(false);
  });

  // Cerrar al hacer click fuera
  document.addEventListener("click", (e) => {
    if (
      !e.target.closest(".proyectos-filtro") &&
      !e.target.closest(".filter-hamburger")
    ) {
      toggleMenu(false);
    }
  });

  // Categorías colapsables
  document.querySelectorAll(".filter-category").forEach((category) => {
    const title = category.querySelector(".category-title");
    const content = category.querySelector(".category-content");

    title?.addEventListener("click", () => {
      category.classList.toggle("active");
      content.classList.toggle("active");
    });
  });

  // Cerrar al redimensionar
  window.addEventListener("resize", () => {
    if (window.innerWidth >= 992) toggleMenu(false);
  });
});
