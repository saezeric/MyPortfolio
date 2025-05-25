<?php
include './components/header.php';
// Consulta dinámica a la tabla QUALIFICATIONS
$qualQuery = "SELECT * FROM QUALIFICATIONS ORDER BY start_date DESC";
$qualResult = $mysqli->query($qualQuery);
?>

<!-- Main Content -->
<div class="main-content">
  <!-- Sección de Introducción Personal -->
  <section class="section">
    <div class="container">
      <h1>Sobre mi</h1>
      <p>
        Soy Eric Saez Escalona, un apasionado del desarrollo web y la tecnología.
        Actualmente estoy cursando el segundo año de Desarrollo de
        Aplicaciones Web (DAW) y me especializo en crear soluciones
        digitales innovadoras y eficientes. Mi interés por la inteligencia
        artificial y su aplicación en el desarrollo web me ha llevado a
        explorar nuevas formas de integrar tecnologías avanzadas en
        proyectos reales.
      </p>
    </div>
  </section>

  <!-- Sección de Formación Profesional -->
  <section class="section">
  <div class="container">
    <h2>Formación Profesional</h2>
    <div class="card-container">
      <?php if ($qualResult && $qualResult->num_rows > 0): ?>
        <?php while($qual = $qualResult->fetch_assoc()): 
          $start = (!empty($qual['start_date']) && $qual['start_date'] !== '0000-00-00') ? date("F Y", strtotime($qual['start_date'])) : "Fecha desconocida";
          $end = (empty($qual['end_date']) || $qual['end_date'] === '0000-00-00') ? "En proceso" : date("F Y", strtotime($qual['end_date']));
          $modalId = "modalQual" . $qual['id'];
        ?>
        <div class="card" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($qual['degree_title']) ?></h5>
            <p class="card-text"><?= htmlspecialchars($qual['institution']) ?></p>
            <p class="card-text text-muted"><?= $start ?> &mdash; <?= $end ?></p>
            <p class="card-text text-muted">Haz clic para ver más</p>
          </div>
        </div>
        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content" style="background-color: #1a0b2e;">
              <div class="modal-header">
                <h5 class="modal-title text-white"><?= htmlspecialchars($qual['degree_title']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body text-white">
                <p><strong>Institución:</strong> <?= htmlspecialchars($qual['institution']) ?></p>
                <p><strong>Período:</strong> <?= $start ?> &mdash; <?= $end ?></p>
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
        <div class="alert alert-info text-center">No hay formación académica disponible.</div>
      <?php endif; ?>
    </div>
  </div>
</section>

  <!-- Sección de Intereses y Enfoque Personal -->
  <section class="section">
    <div class="container">
      <h2>Intereses y Enfoque Personal</h2>
      <div class="intereses-card-container">
        <!-- Card 1 -->
        <div class="intereses-card">
          <div class="card-body">
            <h5 class="card-title">Desarrollo Full-Stack</h5>
            <p class="card-text">
              Combinando frontend y backend para crear soluciones completas.
            </p>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="intereses-card">
          <div class="card-body">
            <h5 class="card-title">Inteligencia Artificial</h5>
            <p class="card-text">
              Explorando cómo la IA puede mejorar la experiencia del
              usuario.
            </p>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="intereses-card">
          <div class="card-body">
            <h5 class="card-title">Diseño UX/UI</h5>
            <p class="card-text">
              Creación de interfaces intuitivas y atractivas.
            </p>
          </div>
        </div>
        <!-- Card 4 -->
        <div class="intereses-card">
          <div class="card-body">
            <h5 class="card-title">Optimización SEO</h5>
            <p class="card-text">
              Mejora del posicionamiento en buscadores.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección de Soft Skills -->
  <section class="soft-skills-section">
    <div class="container">
      <h2>Soft Skills</h2>
      <div class="soft-skills-list">
        <div class="soft-skills-item">
          <h5>Trabajo en Equipo</h5>
          <p>Colaboración efectiva para el éxito de los proyectos.</p>
        </div>
        <div class="soft-skills-item">
          <h5>Aprendizaje Rápido</h5>
          <p>Siempre dispuesto a aprender y adaptarme a nuevos desafíos.</p>
        </div>
        <div class="soft-skills-item">
          <h5>Resolución de Problemas</h5>
          <p>Enfoque creativo para resolver problemas complejos.</p>
        </div>
        <div class="soft-skills-item">
          <h5>Comunicación Efectiva</h5>
          <p>Claridad y precisión en la comunicación.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección de Objetivos a Futuro -->
  <section class="objetivos-section">
    <div class="container">
      <h2>Objetivos a Futuro</h2>
      <div class="objetivos-list">
        <div class="objetivos-item">
          <h5>Corto Plazo</h5>
          <p>
            Ampliar mis conocimientos en desarrollo web e inteligencia
            artificial.
          </p>
        </div>
        <div class="objetivos-item">
          <h5>Largo Plazo</h5>
          <p>
            Liderar equipos de desarrollo y crear soluciones impactantes.
          </p>
        </div>
      </div>
    </div>
  </section>

  <?php
  include './components/footer.php';
  ?>