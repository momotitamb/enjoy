<?php

require_once __DIR__ . '/../layouts/header.php';

?>
    <h1>Создать категорию</h1>

    <div class="post-card">

        <form action="/categories" method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <label>Имя</label>
            <input type="text" name="name" id="name">
            
            <div class="post-actions">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
        
    </div>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
