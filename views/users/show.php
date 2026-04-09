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


<?php require_once __DIR__ . '/../layouts/footer.php';