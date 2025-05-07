<?php
include './components/header.php';
// Consulta a la tabla PROJECTS (ajusta los nombres de columnas si difieren)
$query = "SELECT id, project_title, short_description, image FROM PROJECTS ORDER BY id DESC";
$result = $mysqli->query($query);
?>

<!-- Main Content -->
<div class="main-content">
  <!-- Encabezado -->
  <section class="container mt-5">
    <h1 class="text-center mb-4">Proyectos</h1>
    <p class="text-center">
      Aquí puedes encontrar una lista de mis proyectos más destacados.
    </p>
  </section>

  <!-- Lista de Proyectos -->
  <section class="container mt-5">
    <div class="card-container">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <?php
            // Ajusta el nombre de la columna de imagen si difiere
            $img = !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/300x200'; 
            $title = $row['project_title'];
            $desc = $row['short_description'];
            $projId = $row['id']; 
          ?>
          <div class="card">
            <img
              src="<?= $img; ?>"
              class="card-img-top"
              alt="<?= $title; ?>"
            />
            <div class="card-body">
              <h5 class="card-title"><?= $title; ?></h5>
              <p class="card-text">
                <?= $desc; ?>
              </p>
              <!-- Al hacer clic, enviamos el ID del proyecto a proyecto.php -->
              <a href="proyecto.php?id=<?= $projId; ?>" class="btn btn-primary">Ver más</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <!-- Si no hay registros en la base de datos -->
        <div class="alert alert-info">
          No hay proyectos disponibles en este momento.
        </div>
      <?php endif; ?>
    </div>
  </section>
</div>

  <?php
  include './components/footer.php';
  ?>