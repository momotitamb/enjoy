<?php

require_once __DIR__ . '/../layouts/header.php'; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div style="margin-bottom: 20px;">
            <a href="/posts/create" class="btn btn-primary">+ Создать пост</a>
        </div>
    <?php endif; ?>
    
    <?php foreach ($posts as $post): ?>
        <div class="post-card">
            <div class="card-title">
                <strong><?php echo $post['title']?></strong>
                <br>
                <?php echo $post['category_name'] ?? 'Без категории'; ?>
                <br>
                <small><?php echo 'Дата создания: ' . date('d.m.Y', strtotime($post['created_at'])); ?></small><br>
            </div>

            <div class="post-actions">
                <a href="/posts/<?= $post['id'] ?>/show" class="btn btn-secondary">Просмотр</a>
                
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>

                    <a href="/posts/<?= $post['id'] ?>/edit" class="btn btn-secondary">Редактировать</a>

                    <form class="inline" action="/posts/<?= $post['id'] ?>" method="POST" class="inline" onsubmit="return confirm('Вы уверены?')">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form> 

                <?php endif; ?>
            </div>            

        </div>       


    <?php endforeach; ?>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="btn btn-secondary">← Назад</a>
        <?php endif; ?>

        <?php for ($i=1; $i <= $totalPages; $i++): ?> 
            <a href="?page=<?= $i ?>" class="btn <?= $i === (int)$page ? 'btn-primary' : 'btn-secondary' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>" class="btn btn-secondary">Вперед →</a>
        <?php endif; ?>
    </div>

<?php

require_once __DIR__ . '/../layouts/footer.php';





