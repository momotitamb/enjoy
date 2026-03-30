<?php


require_once __DIR__ . '/layouts/header.php';


echo 'Заголовок: ' . $post['title'] . '<br>';
echo 'Содержание: ' . $post['content'];


require_once __DIR__ . '/layouts/footer.php';