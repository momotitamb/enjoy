<?php

require_once __DIR__ . '/../layouts/header.php';

?>
    <h1>Редактировать пост</h1>

    <div class="post-card">

        <form action="/posts/<?= $post['id'] ?>" method="POST">
            <input type="hidden" name="_method" value="PUT">

            <label>Заголовок</label>
            <input type="text" name="title" id="title" value="<?= htmlspecialchars($post['title']) ?>"><br>
            
            <label>Содержание</label>
            <textarea name="content" id="content"><?= htmlspecialchars($post['content']) ?></textarea>

            <div class="post-actions">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>

    </div>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
