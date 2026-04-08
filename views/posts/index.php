<?php

require_once __DIR__ . '/../layouts/header.php'; ?>

    <div style="margin-bottom: 20px;">
        <a href="/posts/create" class="btn btn-primary">+ Создать пост</a>
    </div>
    
    <?php foreach ($posts as $post) { ?>
        <div class="post-card">

           <?php echo $post['title'] . '<br>'; ?>
           <?php echo $post['category_name'] ?? 'Без категории'; ?>
            <br><br>
            <a href="/posts/<?= $post['id'] ?>/edit" class="btn btn-secondary">Редактировать</a><br>
            
            <div class="post-action">
                <form class="inline" action="/posts/<?= $post['id'] ?>" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Удалить</button><br>
                </form> 
            </div>            

        </div>       


    <?php } ?>

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





