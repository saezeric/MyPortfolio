<?php
include './components/header.php';

// Obtener la experiencia más reciente
$expResult = $mysqli->query("SELECT * FROM EXPERIENCE ORDER BY start_date DESC LIMIT 1");
$experience = $expResult->fetch_assoc();

// Obtener la titulación más reciente
$qualResult = $mysqli->query("SELECT * FROM QUALIFICATIONS ORDER BY start_date DESC LIMIT 1");
$qualification = $qualResult->fetch_assoc();

// Consulta a la tabla PROJECTS (ajusta los nombres de columnas si difieren)
$query = "SELECT id, project_title, short_description, image FROM PROJECTS ORDER BY id DESC";
$result = $mysqli->query($query);

// Consulta a la tabla QUALIFICATIONS para obtener todas las titulaciones
$qualsQuery = "SELECT * FROM QUALIFICATIONS ORDER BY start_date DESC";
$qualsResult = $mysqli->query($qualsQuery);

// Traer las 3 últimas entradas ordenadas por fecha de publicación
$blogQuery = "
    SELECT id, title, short_description, image 
    FROM NEWS 
    ORDER BY publication_date DESC 
    LIMIT 3
";
$blogResult = $mysqli->query($blogQuery);
?>

<!-- Main Content -->
<div class="main-content">
  <!-- Banner -->
  <section class="banner">
    <div class="container">
      <div class="banner-text">
        <h1>¡Hola, soy Eric Saez Escalona!</h1>
        <p class="lead">
          Diseñador web y desarrollador con pasión por crear experiencias
          digitales únicas.
        </p>
        <a href="quien-soy.php" class="btn btn-primary">Conóceme más</a>
      </div>
      <img
        src="./uploads/avatars/0b3b831b16a1ddfc398dbc9155c07e99.jpg"
        alt="Tu Nombre"
        style="width: 500px; height: 500px; object-fit: cover; border-radius: 50%;" />
    </div>
  </section>

  <!-- Resumen Personal -->
  <section class="resumen-personal">
    <div class="container">
      <h2>¿Quién soy?</h2>
      <p>
        Soy un apasionado del desarrollo web y la tecnología, con
        experiencia en la creación de soluciones digitales innovadoras. Mi
        enfoque se centra en ofrecer experiencias de usuario excepcionales y
        en construir proyectos que marquen la diferencia.
      </p>
    </div>
  </section>

  <!-- Sección de Información Relevante -->
  <section class="curriculum">
    <div class="container">
      <h2>Información Relevante</h2>
      <div class="informacion-relevante-container">
        <?php if ($experience): ?>
          <div class="card" data-bs-toggle="modal" data-bs-target="#modalExperiencia<?= $experience['id'] ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($experience['job_title']) ?></h5>
              <p class="card-text text-white">
                <?= date("Y", strtotime($experience['start_date'])) ?> –
                <?= (empty($experience['end_date']) || $experience['end_date']==='0000-00-00') ? 'Actualmente' : date("Y", strtotime($experience['end_date'])) ?>
              </p>
              <p class="card-text text-white">Haz clic para ver más</p>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($qualification): ?>
          <div class="card" data-bs-toggle="modal" data-bs-target="#modalEducacion<?= $qualification['id'] ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($qualification['degree_title']) ?></h5>
              <p class="card-text text-white">
                <?= date("Y", strtotime($qualification['start_date'])) ?> –
                <?= (empty($qualification['end_date']) || $qualification['end_date']==='0000-00-00') ? 'En proceso' : date("Y", strtotime($qualification['end_date'])) ?>
              </p>
              <p class="card-text text-white">Haz clic para ver más</p>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Modal Experiencia -->
  <?php if ($experience): ?>
  <div class="modal fade" id="modalExperiencia<?= $experience['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title"><?= htmlspecialchars($experience['job_title']) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Empresa:</strong> <?= htmlspecialchars($experience['company']) ?></p>
          <p><strong>Periodo:</strong> <?= date("F Y", strtotime($experience['start_date'])) ?> – <?= (empty($experience['end_date']) || $experience['end_date']==='0000-00-00') ? 'Actualmente' : date("F Y", strtotime($experience['end_date'])) ?></p>
          <ul>
            <?php foreach (explode("\n", $experience['job_responsibilities']) as $item): ?>
              <li><?= htmlspecialchars(trim($item)) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Modal Educación -->
  <?php if ($qualification): ?>
  <div class="modal fade" id="modalEducacion<?= $qualification['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title"><?= htmlspecialchars($qualification['degree_title']) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Institución:</strong> <?= htmlspecialchars($qualification['institution']) ?></p>
          <p><strong>Periodo:</strong> <?= date("F Y", strtotime($qualification['start_date'])) ?> – <?= (empty($qualification['end_date']) || $qualification['end_date']==='0000-00-00') ? 'En proceso' : date("F Y", strtotime($qualification['end_date'])) ?></p>
          <ul>
            <?php foreach (explode("\n", $qualification['description']) as $item): ?>
              <li><?= htmlspecialchars(trim($item)) ?></li>
            <?php endforeach; ?>
          </ul>
          <?php if (!empty($qualification['learned_contents'])): ?>
            <hr class="border-secondary">
            <h6>Contenidos aprendidos:</h6>
            <ul>
              <?php foreach (explode("\n", $qualification['learned_contents']) as $item): ?>
                <li><?= htmlspecialchars(trim($item)) ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

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

  <!-- Sección de Titulaciones Oficiales -->
  <section class="section skills-section">
  <div class="container">
    <h2 class="text-center mb-4">Titulaciones Oficiales</h2>
    <div class="titulaciones-container">
      <?php if ($qualsResult && $qualsResult->num_rows > 0): ?>
        <?php while($qual = $qualsResult->fetch_assoc()):
          // Formatear fechas
          $start = (!empty($qual['start_date']) && $qual['start_date'] !== '0000-00-00')
                   ? date("F Y", strtotime($qual['start_date'])) : "Fecha desconocida";
          $end = (empty($qual['end_date']) || $qual['end_date'] === '0000-00-00')
                 ? "En proceso" : date("F Y", strtotime($qual['end_date']));
          $modalId = "modalTitulo" . $qual['id'];
        ?>
        <div class="card" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($qual['degree_title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($qual['institution']) ?></p>
            <p class="card-text"><?= $start ?> — <?= $end ?></p>
            <p class="card-text">Haz clic para ver más detalles.</p>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content" style="background-color:#1a0b2e; color:#fff;">
              <div class="modal-header">
                <h5 class="modal-title"><?= htmlspecialchars($qual['degree_title']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <p><?= nl2br(htmlspecialchars($qual['description'])) ?></p>
                <?php if (!empty($qual['learned_contents'])): ?>
                  <hr class="border-secondary">
                  <h6>Contenidos aprendidos:</h6>
                  <ul>
                    <?php foreach (explode("\n", $qual['learned_contents']) as $item): ?>
                      <li><?= htmlspecialchars(trim($item)) ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="alert alert-info text-center">No hay titulaciones oficiales disponibles.</div>
      <?php endif; ?>
    </div>
  </div>
</section>


  <!-- Sección de últimas entradas del blog -->
  <section class="blog">
    <div class="container">
      <h2 class="text-center mb-4">Últimas Entradas del Blog</h2>
      <div class="card-container">
        <?php if ($blogResult && $blogResult->num_rows > 0): ?>
          <?php while ($post = $blogResult->fetch_assoc()): ?>
            <?php
              $img = !empty($post['image']) ? $post['image'] : 'https://via.placeholder.com/300x200';
            ?>
            <div class="card">
              <img
                src="<?= htmlspecialchars($img); ?>"
                class="card-img-top"
                alt="<?= htmlspecialchars($post['title']); ?>"
                style="width:100%; height:200px; object-fit:cover;"
              />
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($post['title']); ?></h5>
                <p class="card-text"><?= htmlspecialchars($post['short_description']); ?></p>
                <a href="noticia.php?id=<?= (int)$post['id']; ?>" class="btn btn-primary">Leer más</a>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <div class="alert alert-info text-center">No hay entradas disponibles.</div>
        <?php endif; ?>
      </div>
    </div>
  </section>


  <?php
  include './components/footer.php';
  ?>