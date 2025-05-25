<!-- Sección de Comentarios -->
<section class="comments-section py-5">
    <div class="container">
        <h2 class="section-title">
            <?php
            if (! have_comments()) {
                echo 'Deja tu comentario!';
            } else {
                echo get_comments_number() . ' Comentarios';
            }
            ?>
        </h2>

        <?php
        // Obtener solo comentarios principales
        $comments = get_comments([
            'post_id' => get_the_ID(),
            'parent'  => 0,
        ]);
        foreach ($comments as $comment) :
        ?>
            <div class="comment-card">
                <div class="comment-header d-flex align-items-center">
                    <img
                        src="<?php echo esc_url(get_avatar_url($comment->comment_author_email)); ?>"
                        alt="Avatar"
                        class="comment-avatar me-2" />
                    <div>
                        <strong class="comment-author">
                            <?php
                            if ($comment->user_id) {
                                // Usuario registrado
                                $user = get_user_by('id', $comment->user_id);
                                echo esc_html($user->display_name);
                            } else {
                                echo 'Anónimo';
                            }
                            ?>
                        </strong>
                        <small class="comment-date">
                            <?php echo esc_html(get_comment_date('', $comment)); ?>
                        </small>
                    </div>
                </div>
                <p class="comment-text">
                    <?php echo esc_html($comment->comment_content); ?>
                </p>

                <?php
                // Mostrar respuestas
                $replies = get_comments([
                    'post_id' => get_the_ID(),
                    'parent'  => $comment->comment_ID,
                ]);
                foreach ($replies as $reply) :
                ?>
                    <div class="comment-reply">
                        <div class="comment-header d-flex align-items-center">
                            <img
                                src="<?php echo esc_url(get_avatar_url($reply->comment_author_email)); ?>"
                                alt="Avatar"
                                class="comment-avatar me-2" />
                            <div>
                                <strong class="comment-author">
                                    <?php
                                    if ($reply->user_id) {
                                        $u = get_user_by('id', $reply->user_id);
                                        echo esc_html($u->display_name);
                                    } else {
                                        echo 'Anónimo';
                                    }
                                    ?>
                                </strong>
                                <small class="comment-date">
                                    <?php echo esc_html(get_comment_date('', $reply)); ?>
                                </small>
                            </div>
                        </div>
                        <p class="comment-text">
                            <?php echo esc_html($reply->comment_content); ?>
                        </p>
                    </div>
                <?php endforeach; ?>

                <!-- Botón de Responder -->
                <button class="reply-btn" onclick="toggleReplyForm(<?php echo esc_attr($comment->comment_ID); ?>)">
                    <i class="fas fa-reply"></i> Responder
                </button>

                <div
                    id="replyForm-<?php echo esc_attr($comment->comment_ID); ?>"
                    class="reply-form"
                    style="display: none">
                    <form
                        class="comment-form"
                        method="post"
                        action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>">

                        <!-- estos campos evitan el error de “rellena los campos obligatorios” -->
                        <input type="hidden" name="author" value="Anónimo">
                        <input type="hidden" name="email" value="no-reply@<?php echo esc_attr(parse_url(home_url(), PHP_URL_HOST)); ?>">

                        <textarea
                            class="form-control"
                            placeholder="Escribe tu respuesta..."
                            rows="3"
                            required
                            name="comment"></textarea>

                        <input type="hidden" name="comment_post_ID" value="<?php echo esc_attr(get_the_ID()); ?>" />
                        <input type="hidden" name="comment_parent" value="<?php echo esc_attr($comment->comment_ID); ?>" />
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Enviar Respuesta
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Nuevo Comentario -->
        <div class="new-comment">
            <h3>Deja tu comentario</h3>
            <form
                class="comment-form"
                method="post"
                action="<?php echo esc_url(site_url('/wp-comments-post.php')); ?>">

                <!-- estos campos evitan el error de “rellena los campos obligatorios” -->
                <input type="hidden" name="author" value="Anónimo">
                <input type="hidden" name="email" value="no-reply@<?php echo esc_attr(parse_url(home_url(), PHP_URL_HOST)); ?>">

                <textarea
                    class="form-control"
                    placeholder="Escribe tu comentario..."
                    rows="4"
                    required
                    name="comment"></textarea>

                <input type="hidden" name="comment_post_ID" value="<?php echo esc_attr(get_the_ID()); ?>" />
                <button type="submit" class="submit-btn">
                    <i class="fas fa-comment-dots"></i> Enviar Comentario
                </button>
            </form>
        </div>
    </div>
</section>

<script>
    function toggleReplyForm(id) {
        var f = document.getElementById('replyForm-' + id);
        f.style.display = (f.style.display === 'none' || !f.style.display) ? 'block' : 'none';
    }
</script>