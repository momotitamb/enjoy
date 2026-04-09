<?php

require_once __DIR__ . '/../layouts/header.php'; ?>

    <div style="margin-bottom: 20px;">
        <a href="/users/create" class="btn btn-primary">+ Создать пользователя</a>
    </div>
    
    <?php foreach ($users as $user): ?>

        <div class="card">

            <strong><?php echo $user['name'] . '<br>'; ?></strong>
            
            <div class="post-actions">
                
                <a href="/users/<?= $user['id'] ?>/show" class="btn btn-secondary">Просмотр</a>                

                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <a href="/posts/<?= $user['id'] ?>/edit" class="btn btn-secondary">Редактировать</a><br> 
                    <form class="inline" action="/users/<?= $user['id'] ?>" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Удалить</button><br>
                    </form> 
                <?php endif; ?>              

            </div>
        </div>       

    <?php endforeach; ?>

    


require_once __DIR__ . '/../layouts/footer.php';





