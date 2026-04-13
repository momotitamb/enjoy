<?php


require_once __DIR__ . '/../layouts/header.php'; ?>

    <div class="card">
        <h1><?= $post['title'] ?></h1>
    
        <span><?= $post['content'] ?></span><br><br>
        <small><?php echo 'Дата создания: ' . date('d.m.Y', strtotime($post['created_at'])); ?></small><br><br>
    
        <?php if (isset($_SESSION['user_role']) && ($_SESSION['user_role']) === 'admin'): ?>
            
            <a href="/posts/<?= $post['id'] ?>/edit" class="btn btn-secondary">Редактировать</a>
            <form class="inline" action="/posts/<?= $post['id'] ?>" method="POST" class="inline" onsubmit="return confirm('Вы уверены?')">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>

        <?php endif; ?>
    </div>


<?php require_once __DIR__ . '/../layouts/footer.php';