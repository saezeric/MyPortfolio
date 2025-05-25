<?php
include './components/header.php';

/* =============================
 * 1) EXPERIENCIA LABORAL
 * Se asume que la tabla se llama EXPERIENCE
 * y que tiene columnas como:
 * id, job_title, company, start_date, end_date, job_responsibilities
 ============================= */
$exp_query = "SELECT * FROM EXPERIENCE ORDER BY start_date DESC";
$exp_result = $mysqli->query($exp_query);

/* =============================
 * 2) FORMACIÓN ACADÉMICA
 * Se asume que la tabla se llama QUALIFICATIONS
 * y que tiene columnas como:
 * id, degree_title, institution, start_date, end_date, description
 ============================= */
 $qualQuery = "SELECT * FROM QUALIFICATIONS ORDER BY start_date DESC";
 $qualResult = $mysqli->query($qualQuery);

/* =============================
 * 3) PROYECTOS DESTACADOS
 * Se asume que la tabla se llama PROJECTS
 * y que tiene columnas como:
 * id, project_title, short_description, image
 ============================= */
$proj_query = "SELECT id, project_title, short_description, image
               FROM PROJECTS
               ORDER BY id DESC
               LIMIT 3"; // Ajusta el LIMIT según tus necesidades
$proj_result = $mysqli->query($proj_query);
?>

<!-- Fuerza que .text-muted sea blanco -->
<style>
  .text-muted {
    color: #fff !important;
  }
</style>

<!-- Main Content -->
<div class="main-content">
  <!-- Encabezado -->
  <section class="container mt-5">
    <h1 class="text-center mb-4">Eric Sáez</h1>
    <h2 class="text-center mb-4">Full Stack | Especialista en IA</h2>
  </section>

  <!-- Perfil Profesional -->
  <section class="container mt-5">
    <h2>Perfil Profesional</h2>
    <p>
      Soy un desarrollador Full Stack con especialización en Inteligencia
      Artificial. Actualmente curso un Máster en IA y un Grado Superior en
      Desarrollo de Aplicaciones Web. Me considero una persona segura,
      responsable y perseverante, con alta capacidad de aprendizaje y
      liderazgo. Tengo experiencia en el desarrollo de aplicaciones web,
      automatización con IA y creación de contenidos SEO. Busco
      oportunidades para seguir creciendo profesionalmente y contribuir en
      proyectos innovadores.
    </p>
  </section>

  <!-- Competencias Digitales -->
  <section class="container mt-5">
    <h2>Competencias Digitales</h2>
    <table class="table table-dark">
      <thead>
        <tr>
          <th>Competencia</th>
          <th>Nivel</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Alfabetización en información y datos</td>
          <td>Avanzado</td>
        </tr>
        <tr>
          <td>Comunicación y colaboración</td>
          <td>Avanzado</td>
        </tr>
        <tr>
          <td>Creación de contenidos digitales</td>
          <td>Avanzado</td>
        </tr>
        <tr>
          <td>Seguridad</td>
          <td>Avanzado</td>
        </tr>
        <tr>
          <td>Resolución de problemas</td>
          <td>Avanzado</td>
        </tr>
      </tbody>
    </table>
  </section>

  <!-- Experiencia Laboral (Dinámica con modales) -->
  <section class="container mt-5">
    <h2>Experiencia Laboral</h2>
    <div class="card-container">
      <?php if ($exp_result && $exp_result->num_rows > 0): ?>
        <?php while($exp = $exp_result->fetch_assoc()): ?>
          <?php
            // Formatear fecha de inicio
            $start = $exp['start_date'];
            $startFmt = (!empty($start) && $start != '0000-00-00') ? date("F Y", strtotime($start)) : "Sin fecha de inicio";
            // Formatear fecha de fin
            $end = $exp['end_date'];
            $endFmt = (empty($end) || $end == '0000-00-00') ? "Actualmente" : date("F Y", strtotime($end));
            // ID único para el modal
            $modalId = "modalExp" . $exp['id'];
          ?>
          <div class="card" data-bs-toggle="modal" data-bs-target="#<?= $modalId; ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($exp['job_title']); ?></h5>
              <p class="card-text">
                <?= htmlspecialchars($exp['company']); ?><br>
                <small class="text-muted"><?= htmlspecialchars($startFmt); ?> - <?= htmlspecialchars($endFmt); ?></small>
              </p>
              <p class="card-text text-muted">Haz clic para ver más</p>
            </div>
          </div>

          <!-- Modal de esta experiencia -->
          <div class="modal fade" id="<?= $modalId; ?>" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content" style="background-color: #1a0b2e;">
                <div class="modal-header">
                  <h5 class="modal-title" style="color: #fff;">
                    <?= htmlspecialchars($exp['job_title']); ?>
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: #fff;">
                  <p>
                    <strong>Empresa:</strong> <?= htmlspecialchars($exp['company']); ?><br>
                    <strong>Período:</strong> <?= htmlspecialchars($startFmt); ?> - <?= htmlspecialchars($endFmt); ?>
                  </p>
                  <p>
                    <?= nl2br(htmlspecialchars($exp['job_responsibilities'])); ?>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    Cerrar
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No hay experiencia laboral disponible.</p>
      <?php endif; ?>
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

  <!-- Habilidades Técnicas (Sección estática) -->
  <section class="container mt-5">
    <h2>Habilidades Técnicas</h2>
    <div class="card-container">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Lenguajes de Programación</h5>
          <p class="card-text">
            Java, C#, C++, Python, JavaScript, PHP, SQL.
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Frameworks</h5>
          <p class="card-text">Django, Bootstrap 5.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Entornos de Desarrollo</h5>
          <p class="card-text">Visual Studio, VS Code, NetBeans.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Proyectos Destacados (Dinámico) -->
  <section class="container mt-5">
    <h2>Proyectos Destacados</h2>
    <div class="card-container">
      <?php if ($proj_result && $proj_result->num_rows > 0): ?>
        <?php while($proj = $proj_result->fetch_assoc()): ?>
          <?php
            $proj_img = !empty($proj['image']) ? $proj['image'] : 'https://via.placeholder.com/300x200';
            $proj_title = $proj['project_title'];
            $proj_desc = $proj['short_description'];
            $projId = $proj['id'];
          ?>
          <div class="card">
            <img
              src="<?= htmlspecialchars($proj_img); ?>"
              class="card-img-top"
              alt="<?= htmlspecialchars($proj_title); ?>"
              style="width:100%; height:200px; object-fit:cover;"
            />
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($proj_title); ?></h5>
              <p class="card-text"><?= htmlspecialchars($proj_desc); ?></p>
              <a href="proyecto.php?id=<?= $projId; ?>" class="btn btn-primary">Ver Proyecto</a>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="alert alert-info">
          No hay proyectos disponibles en este momento.
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- Resto de secciones estáticas (Competencias Personales, Idiomas, etc.) -->
  <section class="container mt-5">
    <h2>Competencias Personales</h2>
    <div class="card-container">
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-comments fa-2x mb-3"></i>
          <h5 class="card-title">Alta capacidad de comunicación</h5>
          <p class="card-text">
            Habilidad para comunicar ideas de manera clara y efectiva.
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-users fa-2x mb-3"></i>
          <h5 class="card-title">Trabajo en equipo</h5>
          <p class="card-text">
            Colaboración efectiva en entornos grupales.
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-hand-holding-heart fa-2x mb-3"></i>
          <h5 class="card-title">Empatía y confianza</h5>
          <p class="card-text">
            Capacidad para entender y conectar con los demás.
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-brain fa-2x mb-3"></i>
          <h5 class="card-title">Optimismo y perseverancia</h5>
          <p class="card-text">
            Enfoque positivo y determinación para superar desafíos.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Idiomas -->
  <section class="container mt-5">
    <h2>Idiomas</h2>
    <div class="card-container">
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-language fa-2x mb-3"></i>
          <h5 class="card-title">Castellano</h5>
          <p class="card-text">Nativo</p>
        </div>
      </div>
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-language fa-2x mb-3"></i>
          <h5 class="card-title">Catalán</h5>
          <p class="card-text">Nativo</p>
        </div>
      </div>
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-language fa-2x mb-3"></i>
          <h5 class="card-title">Inglés</h5>
          <p class="card-text">Alto</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Certificaciones y Cursos Adicionales -->
  <section class="container mt-5">
    <h2>Certificaciones y Cursos Adicionales</h2>
    <div class="card-container">
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-certificate fa-2x mb-3"></i>
          <h5 class="card-title">WordPress Básico y Elementor Pro</h5>
          <p class="card-text">
            Certificación en diseño y desarrollo con WordPress.
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-certificate fa-2x mb-3"></i>
          <h5 class="card-title">
            Cursos de IA generativa y automatización
          </h5>
          <p class="card-text">
            Especialización en IA generativa y automatización de tareas.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Intereses y Hobbies -->
  <section class="container mt-5">
    <h2>Intereses y Hobbies</h2>
    <div class="card-container">
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-gamepad fa-2x mb-3"></i>
          <h5 class="card-title">Desarrollo de videojuegos con Unity</h5>
          <p class="card-text">
            Creación de videojuegos y experiencias interactivas.
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-code fa-2x mb-3"></i>
          <h5 class="card-title">Participación en hackathones</h5>
          <p class="card-text">
            Competencias de programación y desarrollo de soluciones innovadoras.
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-body text-center">
          <i class="fas text-white fa-camera fa-2x mb-3"></i>
          <h5 class="card-title">Fotografía digital</h5>
          <p class="card-text">Captura y edición de imágenes digitales.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Descarga del CV -->
  <section class="container mt-5 text-center">
    <a href="cv.pdf" class="btn btn-primary" download>Descargar CV</a>
  </section>
</div>

<?php
include './components/footer.php';
?>
