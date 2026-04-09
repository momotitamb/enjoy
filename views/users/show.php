<?php


require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="card">
    <form action="users/{id}/show">
        <label>Имя: </label>
        <input type="text" value="<?= $user['name'] ?>">

        <label>Email: </label>
        <input type="email" value="<?= $user['email'] ?>">
    </form>
</div>



<?php require_once __DIR__ . '/../layouts/footer.php';