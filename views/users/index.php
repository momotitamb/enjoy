<?php

require_once __DIR__ . '/../layouts/header.php'; ?>
    
    <?php foreach ($users as $user) { ?>
        <div class="post-card">

           <?php echo $user['name'] . '<br>'; ?>
            
            <div class="post-action">

                <form class="inline" action="/users/<?= $user['id'] ?>" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Удалить</button><br>
                </form> 

            </div>            

        </div>       


    <?php }

    


require_once __DIR__ . '/../layouts/footer.php';





