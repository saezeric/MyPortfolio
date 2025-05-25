<?php
include './components/header.php';
?>
<!-- Main Content -->
<div class="main-content">
  <!-- Banner de Contacto -->
  <section class="contact-banner">
    <h2>Contacto</h2>
    <p>
      Si estás interesado en mi perfil o tienes alguna pregunta, no dudes en
      contactarme. Estoy disponible para colaboraciones, proyectos y
      oportunidades laborales.
    </p>

    <!-- Información de Contacto -->
    <div class="contact-info">
      <div>
        <i class="fas fa-phone"></i>
        <p>+34 633 19 14 60</p>
      </div>
      <div>
        <i class="fas fa-envelope"></i>
        <p>ericsaez13@gmail.com</p>
      </div>
      <div>
        <i class="fas fa-map-marker-alt"></i>
        <p>Barcelona, España</p>
      </div>
    </div>

    <!-- Formulario de Contacto -->
    <div class="contact-form">
      <form id="contactForm" novalidate>
        <input type="text" placeholder="Nombre" required />
        <span class="error-message" id="contact-error-name"></span>

        <input type="email" placeholder="Correo Electrónico" required />
        <span class="error-message" id="contact-error-email"></span>

        <textarea
          placeholder="Escribe tu mensaje aquí..."
          rows="5"
          required></textarea>
        <span class="error-message" id="contact-error-message"></span>

        <button type="submit">Enviar Mensaje</button>
      </form>
    </div>
  </section>

  <!-- Mapa de Google Maps -->
  <div
    class="map-container"
    style="
          margin: 40px auto;
          max-width: 800px;
          border-radius: 10px;
          overflow: hidden;
        ">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2993.013671588592!2d2.245032315422792!3d41.45004197925856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4bcf3e7b4b7b7%3A0x8b8b8b8b8b8b8b8b!2sBadalona%2C%20Barcelona%2C%20Spain!5e0!3m2!1sen!2ses!4v1634567890123!5m2!1sen!2ses"
      width="100%"
      height="800"
      style="border: 0"
      allowfullscreen=""
      loading="lazy"></iframe>
  </div>

  <?php

  include './components/footer-contacto.php';

  ?>