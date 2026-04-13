<?php

require_once __DIR__ . '/../layouts/header.php'; ?>

    <div style="margin-bottom: 20px;">
        <a href="/register" class="btn btn-primary">+ Создать пользователя</a>
    </div>
    
    <?php foreach ($users as $user): ?>

        <div class="card">

            <div class="card-title">
                <strong><?php echo $user['name']; ?></strong>
            </div>

            <div class="post-actions">
                
                <a href="/users/<?= $user['id'] ?>/show" class="btn btn-secondary">Просмотр</a>            

                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <a href="/users/<?= $user['id'] ?>/edit" class="btn btn-secondary">Редактировать</a>

                    <form class="inline" action="/users/<?= $user['id'] ?>" method="POST" onsubmit="return confirm('Вы уверены?')">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form> 
                <?php endif; ?>              

            </div>
        </div>       

    <?php endforeach;   


require_once __DIR__ . '/../layouts/footer.php';





