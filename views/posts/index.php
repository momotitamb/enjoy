<?php

require_once __DIR__ . '/../layouts/header.php'; ?>
    
    <?php foreach ($posts as $post) { ?>
        <div class="post-card">

           <?php echo $post['title'] . '<br>'; ?>

            <a href="/posts/<?= $post['id'] ?>/edit" class="btn btn-secondary">Редактировать</a><br>
            
            <div class="post-action">
                <form class="inline" action="/posts/<?= $post['id'] ?>" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Удалить</button><br>
                </form> 
            </div>            

        </div>       


    <?php }

    


require_once __DIR__ . '/../layouts/footer.php';





