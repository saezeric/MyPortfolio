<!-- Sección de Comentarios -->
<section class="comments-section py-5">
    <div class="container">
        <h2 class="section-title">
            <?php
            if (!have_comments()) {
                echo 'Deja tu comentario!';
            } else {
                echo get_comments_number() . ' Comentarios';
            }
            ?>
        </h2>

        <?php
        // Mostrar solo comentarios principales (comment_parent = 0)
        $comments = get_comments(array(
            'post_id' => get_the_ID(),
            'parent' => 0 // Solo comentarios principales
        ));
        foreach ($comments as $comment) :
        ?>
            <div class="comment-card">
                <div class="comment-header d-flex align-items-center">
                    <img
                        src="<?php echo get_avatar_url($comment->comment_author_email); ?>"
                        alt="Avatar"
                        class="comment-avatar me-2" />
                    <div>
                        <strong class="comment-author">
                            <?php echo $comment->comment_author ? $comment->comment_author : 'Anónimo'; ?>
                        </strong>
                        <small class="comment-date"><?php echo get_comment_date('', $comment); ?></small>
                    </div>
                </div>
                <p class="comment-text">
                    <?php echo $comment->comment_content; ?>
                </p>

                <?php
                // Mostrar respuestas al comentario
                $replies = get_comments(array(
                    'parent' => $comment->comment_ID, // Solo respuestas a este comentario
                    'post_id' => get_the_ID()
                ));
                foreach ($replies as $reply) :
                ?>
                    <div class="comment-reply">
                        <div class="comment-header d-flex align-items-center">
                            <img
                                src="<?php echo get_avatar_url($reply->comment_author_email); ?>"
                                alt="Avatar"
                                class="comment-avatar me-2" />
                            <div>
                                <strong class="comment-author">
                                    <?php echo $reply->comment_author ? $reply->comment_author : 'Anónimo'; ?>
                                </strong>
                                <small class="comment-date"><?php echo get_comment_date('', $reply); ?></small>
                            </div>
                        </div>
                        <p class="comment-text">
                            <?php echo $reply->comment_content; ?>
                        </p>
                    </div>
                <?php endforeach; ?>

                <!-- Botón de Responder -->
                <button class="reply-btn" onclick="toggleReplyForm(<?php echo $comment->comment_ID; ?>)">
                    <i class="fas fa-reply"></i>
                    Responder
                </button>
                <div id="replyForm-<?php echo $comment->comment_ID; ?>" class="reply-form" style="display: none">
                    <form class="comment-form" method="post" action="<?php echo site_url('/wp-comments-post.php'); ?>">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Tu nombre"
                            required
                            style="color: #555"
                            name="author" />
                        <textarea
                            class="form-control"
                            placeholder="Escribe tu respuesta..."
                            rows="3"
                            required
                            style="color: #555"
                            name="comment"></textarea>
                        <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" />
                        <input type="hidden" name="comment_parent" value="<?php echo $comment->comment_ID; ?>" />
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i>
                            Enviar Respuesta
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Formulario para Nuevo Comentario -->
        <div class="new-comment">
            <h3>Deja tu comentario</h3>
            <form class="comment-form" method="post" action="<?php echo site_url('/wp-comments-post.php'); ?>">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Tu nombre"
                    required
                    style="color: #555"
                    name="author" />
                <textarea
                    class="form-control"
                    placeholder="Escribe tu comentario..."
                    rows="4"
                    required
                    style="color: #555"
                    name="comment"></textarea>
                <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" />
                <button type="submit" class="submit-btn">
                    <i class="fas fa-comment-dots"></i>
                    Enviar Comentario
                </button>
            </form>
        </div>
    </div>
</section>