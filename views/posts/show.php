<?php


require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="post-card">
    <?php echo 'Заголовок: ' . $post['title'] . '<br>';
    echo 'Содержание: ' . $post['content']; ?>
</div>



<?php require_once __DIR__ . '/../layouts/footer.php';