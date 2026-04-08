<?php

require_once __DIR__ . '/../layouts/header.php';

?>
    <h1>Вход</h1>

    <div class="card">

        <form action="/login" method="POST">
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($_POST['email']) ?>">
            
            <label>Пароль:</label>
            <input type="password" name="password" value="<?= htmlspecialchars($_POST['password']) ?>">
            
            <div class="post-actions">
                <button type="submit" class="btn btn-primary">Войти</button>
            </div>
        </form>
        
    </div>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
