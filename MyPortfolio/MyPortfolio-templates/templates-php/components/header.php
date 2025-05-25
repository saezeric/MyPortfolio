<?php
session_start();
require_once 'config.php'; // Incluimos el archivo de configuración
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Curriculum</title>
  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <!-- Google Fonts: Poppins -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
    rel="stylesheet" />
  <!-- Font Awesome para iconos -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet" />

  <link rel="stylesheet" href="./styles/style.css" />
</head>

<body>
  <!-- Botón para abrir/cerrar el menú en móviles/tablets -->
  <button class="menu-toggle" id="menuToggle">☰</button>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <?php if (isset($_SESSION['user_id'])): ?>
      <!-- Solo muestra el avatar y dropdown si el usuario está logueado -->
      <div class="dropdown text-center">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?= htmlspecialchars($_SESSION['user_avatar']) ?>" alt="Avatar" style="width: 150px; height: 150px; object-fit: cover;" class="rounded-circle">
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
            <li><a class="dropdown-item" href="./admin/admin.php">Panel Admin</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
          <?php endif; ?>
          <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
        </ul>
      </div>
    <?php endif; ?>

    <nav>
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="quien-soy.php">¿Quién soy?</a></li>
        <li><a href="curriculum.php">Curriculum</a></li>
        <li><a href="proyectos.php">Proyectos</a></li>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="contacto.php">Contacto</a></li>
      </ul>
    </nav>

    <?php if (!isset($_SESSION['user_id'])): ?>
      <!-- Opciones de usuario: Iniciar Sesión y Registrarse, solo si no está logueado -->
      <div class="user-options mt-3 text-center">
        <a href="login.php" class="btn btn-outline-primary mb-2 d-block">Iniciar Sesión</a>
        <a href="register.php" class="btn btn-outline-secondary d-block">Registrarse</a>
      </div>
    <?php endif; ?>
  </div>