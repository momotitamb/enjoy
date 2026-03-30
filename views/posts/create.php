<?php

require_once __DIR__ . '/../layouts/header.php';

?>
    <h1>Создать пост</h1>

    <form action="/posts" method="POST">
        <label>Заголовок</label>
        <input type="text" name="title" id="title"><br>
        
        <label>Содержание</label>
        <textarea name="content" id="content"></textarea>

        <button type="submit">Создать</button>
    </form>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
