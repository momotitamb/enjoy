<?php

require_once __DIR__ . '/../layouts/header.php'; ?>
    
    <a href="categories/create" class="btn btn-primary">Создать категорию</a>
    <?php foreach ($categories as $category) { ?>
        <div class="post-card">

           <?php echo $category['name'] . '<br>'; ?>
            
            <div class="post-action">

                <form class="inline" action="/categories/<?= $category['id'] ?>" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Удалить</button><br>

                </form> 
            </div>            

        </div>       


    <?php }

    


require_once __DIR__ . '/../layouts/footer.php';





