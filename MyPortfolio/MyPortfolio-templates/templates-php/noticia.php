<?php
ob_start();
include("./components/header.php");

// Procesar la inserción de comentarios/respuestas si se envía el formulario (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news_id = isset($_POST['news_id']) ? (int) $_POST['news_id'] : 0;
    $user_id = isset($_POST['user_id']) ? (int) $_POST['user_id'] : 0;
    $comment_text = isset($_POST['comment_text']) ? trim($_POST['comment_text']) : "";
    $parent_comment_id = (isset($_POST['parent_comment_id']) && !empty($_POST['parent_comment_id'])) ? (int) $_POST['parent_comment_id'] : null;

    if ($news_id > 0 && $user_id > 0 && !empty($comment_text)) {
        if ($parent_comment_id === null) {
            // Comentario de nivel superior
            $sql_insert = "INSERT INTO COMMENTS (user_id, news_id, comment_text, comment_date) VALUES (?, ?, ?, NOW())";
            $stmt = $mysqli->prepare($sql_insert);
            $stmt->bind_param("iis", $user_id, $news_id, $comment_text);
        } else {
            // Respuesta a un comentario
            $sql_insert = "INSERT INTO COMMENTS (user_id, news_id, parent_comment_id, comment_text, comment_date) VALUES (?, ?, ?, ?, NOW())";
            $stmt = $mysqli->prepare($sql_insert);
            $stmt->bind_param("iiis", $user_id, $news_id, $parent_comment_id, $comment_text);
        }
        $stmt->execute();
        $stmt->close();
    }
    // Redirigir inmediatamente para evitar reenvío del formulario
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

// Obtener el ID de la noticia desde la URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Consultar la noticia en la base de datos
$sql = "SELECT * FROM NEWS WHERE id = $id";
$result = mysqli_query($mysqli, $sql);

if ($result && $row = mysqli_fetch_assoc($result)) {
?>
  <!-- Hero Section -->
  <section class="hero-section" style="background-image: url('<?php echo $row['image']; ?>');">
    <div class="hero-overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-12 text-center">
          <h1 class="hero-title"><?php echo $row['title']; ?></h1>
          <p class="hero-subtitle"><?php echo $row['short_description']; ?></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contenido de la noticia -->
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <p class="publication-date">Publicado el <?php echo date("F j, Y", strtotime($row['publication_date'])); ?></p>
          
          <div class="news-content">
            <h2 class="detail-title"><?php echo $row['detail_title1']; ?></h2>
            <p><?php echo $row['detail_description1']; ?></p>
            
            <h2 class="detail-title"><?php echo $row['detail_title2']; ?></h2>
            <p><?php echo $row['detail_description2']; ?></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Sección de Comentarios -->
  <section class="section">
    <div class="container">
      <h2 class="section-title">Comentarios</h2>
      <?php
      // Consultar los comentarios de nivel superior para esta noticia
      $comments_query = "SELECT C.*, U.first_name, U.last_name, U.avatar 
                         FROM COMMENTS C 
                         LEFT JOIN USERS U ON C.user_id = U.id 
                         WHERE C.news_id = $id AND C.parent_comment_id IS NULL 
                         ORDER BY C.comment_date ASC";
      $comments_result = mysqli_query($mysqli, $comments_query);
      
      if ($comments_result && mysqli_num_rows($comments_result) > 0) {
          while ($comment = mysqli_fetch_assoc($comments_result)) {
      ?>
            <div class="comment-box">
              <div class="comment-header">
                <img src="<?php echo $comment['avatar']; ?>" alt="Avatar" class="comment-avatar">
                <div>
                  <strong class="comment-author"><?php echo $comment['first_name'] . ' ' . $comment['last_name']; ?></strong>
                  <small class="comment-date"><?php echo date("F j, Y", strtotime($comment['comment_date'])); ?></small>
                </div>
              </div>
              <p class="comment-text"><?php echo $comment['comment_text']; ?></p>
              
              <!-- Listado de respuestas -->
              <?php
              $reply_query = "SELECT C.*, U.first_name, U.last_name, U.avatar 
                              FROM COMMENTS C 
                              LEFT JOIN USERS U ON C.user_id = U.id 
                              WHERE C.parent_comment_id = " . $comment['id'] . " 
                              ORDER BY C.comment_date ASC";
              $reply_result = mysqli_query($mysqli, $reply_query);
              if ($reply_result && mysqli_num_rows($reply_result) > 0) {
                  while ($reply = mysqli_fetch_assoc($reply_result)) {
              ?>
                      <div class="comment-reply">
                        <div class="comment-header">
                          <img src="<?php echo $reply['avatar']; ?>" alt="Avatar" class="comment-avatar">
                          <div>
                            <strong class="comment-author"><?php echo $reply['first_name'] . ' ' . $reply['last_name']; ?></strong>
                            <small class="comment-date"><?php echo date("F j, Y", strtotime($reply['comment_date'])); ?></small>
                          </div>
                        </div>
                        <p class="comment-text"><?php echo $reply['comment_text']; ?></p>
                      </div>
              <?php
                  }
              }
              ?>
              
              <!-- Botón para mostrar/ocultar el formulario de respuesta -->
              <?php if(isset($_SESSION['user_id'])): ?>
                <button class="reply-btn" onclick="toggleReplyForm(<?php echo $comment['id']; ?>)">Responder</button>
                <div id="replyForm-<?php echo $comment['id']; ?>" class="reply-form">
                  <form method="POST" action="">
                    <input type="hidden" name="news_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="parent_comment_id" value="<?php echo $comment['id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                    <textarea name="comment_text" class="form-control" placeholder="Escribe tu respuesta..." required></textarea>
                    <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
                  </form>
                </div>
              <?php endif; ?>
            </div>
      <?php
          }
      } else {
          echo "<p class='no-comments'>No hay comentarios para esta noticia.</p>";
      }
      ?>
      
      <!-- Formulario para añadir un nuevo comentario de nivel superior -->
      <?php if(isset($_SESSION['user_id'])): ?>
        <div class="new-comment">
          <h3>Deja tu comentario</h3>
          <form method="POST" action="">
            <input type="hidden" name="news_id" value="<?php echo $id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <textarea name="comment_text" class="form-control" placeholder="Escribe tu comentario..." required></textarea>
            <button type="submit" class="btn btn-primary">Enviar Comentario</button>
          </form>
        </div>
      <?php else: ?>
        <div class="login-prompt">
          <p>Debes <a href="login.php">iniciar sesión</a> para dejar un comentario.</p>
        </div>
      <?php endif; ?>
    </div>
  </section>

<?php
} else {
  echo "<div class='container'><p class='not-found'>Noticia no encontrada.</p></div>";
}

include("./components/footer.php");
?>

<!-- Script para mostrar/ocultar el formulario de respuesta -->
<script>
function toggleReplyForm(commentId) {
    var replyForm = document.getElementById("replyForm-" + commentId);
    if (replyForm.style.display === "none" || !replyForm.style.display) {
        replyForm.style.display = "block";
    } else {
        replyForm.style.display = "none";
    }
}

// Inicialmente ocultar todos los formularios de respuesta
document.addEventListener('DOMContentLoaded', function() {
    var replyForms = document.querySelectorAll('[id^="replyForm-"]');
    replyForms.forEach(function(form) {
        form.style.display = 'none';
    });
});
</script>