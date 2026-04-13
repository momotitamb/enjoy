<?php


require_once __DIR__ . '/../layouts/header.php'; ?>


    <div class="detail-row">
        <span class="detail-label">Имя</span>
        <span class="detail-value"><?= $user['name'] ?></span>
    </div>
    
    <div class="detail-row">
        <span class="detail-label">Email</span>
        <span class="detail-value"><?= $user['email'] ?></span>
    </div>

    <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <div class="detail-row">
            <span class="detail-label">Дата регистрации:</span>
            <span class="detail-value"><?= date('d.m.Y', strtotime($user['created_at'])); ?></span>
        </div>
    <?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php';