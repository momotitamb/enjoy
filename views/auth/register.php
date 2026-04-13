<?php

require_once __DIR__ . '/../layouts/header.php';

?>
    <h1>Регистрация</h1>

    <div class="card">

        <form action="/register" method="POST" autocomplete="off">

            <label>Имя:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['old']['name'] ?? '') ?>">

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['old']['email'] ?? '') ?>">

            <label>Пароль:</label>
            <input type="password" name="password">
            
            <label>Подтверждение пароля:</label>
            <input type="password" name="confirm_password">
            
            <div class="post-actions">
                <button type="submit" class="btn btn-primary">Регистрация</button>
            </div>

        </form>
        
    </div>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
