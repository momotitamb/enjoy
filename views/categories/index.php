<?php

require_once __DIR__ . '/../layouts/header.php'; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div style="margin-bottom: 20px;">
            <a href="/categories/create" class="btn btn-primary">+ Создать категорию</a>
        </div>
    <?php endif; ?>
    

    <?php foreach ($categories as $category): ?>
        <div class="card">
            <div class="card-title">
                <strong><?php echo $category['name']; ?></strong>
            </div>
            
            <div class="post-actions">

                <?php if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] === 'admin')): ?>
                    
                    <form class="inline" action="/categories/<?= $category['id'] ?>" method="POST" onsubmit="return confirm('Вы уверены?')">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Удалить</button><br>
                    </form>

                <?php endif; ?>
                
            </div>            

        </div>       


    <?php endforeach;

    


require_once __DIR__ . '/../layouts/footer.php';





