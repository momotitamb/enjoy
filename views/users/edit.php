<?php

require_once __DIR__ . '/../layouts/header.php';

?>
    <h1>Редактировать пользователя</h1>

    <div class="post-card">

        <form action="/users/<?= $user['id'] ?>" method="POST">
            <input type="hidden" name="_method" value="PUT">

            <label>Имя</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>">
            
            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">

            <div class="post-actions">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>

    </div>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
