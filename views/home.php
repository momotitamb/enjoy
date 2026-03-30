<?php

require_once __DIR__ . '/layouts/header.php';

    foreach ($posts as $post) {
        echo $post['title'] . '<br>';
    }


require_once __DIR__ . '/layouts/footer.php';





