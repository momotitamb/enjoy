<?php

require_once __DIR__ . '/../layouts/header.php';

?>
    <h1>Вход</h1>

    <div class="card">

        <form action="/login" method="POST" autocomplete="off">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            
            <label>Email:</label>
            <input type="email" name="email">
            
            <label>Пароль:</label>
            <input type="password" name="password" autocomplete="new-password">
            
            <div class="post-actions">
                <button type="submit" class="btn btn-primary">Войти</button>
            </div>
        </form>
        
    </div>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
