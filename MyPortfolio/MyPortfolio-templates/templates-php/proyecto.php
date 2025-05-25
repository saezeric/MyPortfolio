<?php
include("./components/header.php");

// Verificar si se ha pasado el parámetro 'id' en la URL
if (isset($_GET['id'])) {
    $project_id = (int)$_GET['id'];

    // Consulta SQL para obtener los datos del proyecto basado en el ID
    $sql = "SELECT * FROM PROJECTS WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $project = $result->fetch_assoc();
    } else {
        // Si no se encuentra el proyecto, mostrar error
        die("<div class='container'><p class='error-message'>Proyecto no encontrado.</p></div>");
    }
} else {
    // Si no se proporciona el ID, mostrar error
    die("<div class='container'><p class='error-message'>ID del proyecto no proporcionado.</p></div>");
}
?>

<!-- Hero Section -->
<section class="hero-section" style="background-image: url('<?= $project['image']; ?>');">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="hero-title"><?= htmlspecialchars($project['project_title']); ?></h1>
                <p class="hero-subtitle"><?= htmlspecialchars($project['short_description']); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Project Details -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="project-content">
                    <h2 class="detail-title"><?= htmlspecialchars($project['detail_title1']); ?></h2>
                    <p><?= nl2br(htmlspecialchars($project['detail_description1'])); ?></p>
                    
                    <h2 class="detail-title"><?= htmlspecialchars($project['detail_title2']); ?></h2>
                    <p><?= nl2br(htmlspecialchars($project['detail_description2'])); ?></p>
                </div>
                
                <!-- Demo Section -->
                <div class="demo-section mt-5">
                    <h2 class="section-title">Demo del Proyecto</h2>
                    <iframe 
                        src="<?= htmlspecialchars($project['deployment_link']); ?>" 
                        width="100%" 
                        height="1000px" 
                        style="border: none; border-radius: 10px; background: #fff;"
                        title="Demo de <?= htmlspecialchars($project['project_title']); ?>"></iframe>
                </div>
                
                <!-- Links Section -->
                <div class="links-section mt-5 text-center">
                    <a href="<?= htmlspecialchars($project['repository']); ?>" class="btn btn-primary mr-3" target="_blank">
                        Ver Repositorio en GitHub
                    </a>
                    <a href="<?= htmlspecialchars($project['deployment_link']); ?>" class="btn btn-outline-primary" target="_blank">
                        Ver Proyecto en Vivo
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section cta-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2>¿Interesado en más proyectos?</h2>
                <p class="mb-4">Explora otros proyectos en mi portafolio o contáctame para colaborar.</p>
                <a href="proyectos.php" class="btn btn-primary mr-3">Ver Portafolio</a>
                <a href="contacto.php" class="btn btn-outline-primary">Contactar</a>
            </div>
        </div>
    </div>
</section>

<?php
include("./components/footer.php");
?>