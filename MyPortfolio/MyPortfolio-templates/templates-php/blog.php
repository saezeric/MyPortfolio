<?php
include './components/header.php';
// Consulta a la tabla NEWS (ajusta nombres de columnas si difieren)
$query = "SELECT id, title, short_description, image FROM NEWS ORDER BY id DESC";
$result = $mysqli->query($query);
?>

<!-- Main Content -->
<div class="main-content">
  <!-- Encabezado -->
  <section class="container mt-5">
    <h1 class="text-center mb-4">Blog</h1>
    <p class="text-center">
      Aquí puedes encontrar una lista de mis noticias más destacados.
    </p>
  </section>

  <!-- Lista de Noticias -->
  <section class="container mt-5">
    <div class="card-container">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <?php
            // Ajusta el nombre de la columna de imagen si difiere
            $img = !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/300x200'; 
            $title = $row['title'];
            $desc = $row['short_description'];
            $newsId = $row['id']; 
          ?>
          <div class="card">
            <img
              src="<?= $img; ?>"
              class="card-img-top"
              alt="<?= $title; ?>"
              style="width: 100%; height: 200px; object-fit: cover;"
            />
            <div class="card-body">
              <h5 class="card-title"><?= $title; ?></h5>
              <p class="card-text">
                <?= $desc; ?>
              </p>
              <!-- Al hacer clic, podemos enviar el ID de la noticia para mostrar su detalle en noticia.php -->
              <a href="noticia.php?id=<?= $newsId; ?>" class="btn btn-primary">Leer Más</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <!-- Si no hay registros en la base de datos -->
        <div class="alert alert-info">
          No hay noticias disponibles en este momento.
        </div>
      <?php endif; ?>
    </div>
  </section>
</div>

<?php
include './components/footer.php';
?>
