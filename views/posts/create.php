<?php

require_once __DIR__ . '/../layouts/header.php';

?>
    <h1>Создать пост</h1>

    <div class="post-card">

        <form action="/posts" method="POST">
            <label>Заголовок</label>
            <input type="text" name="title" id="title"><br>
            
            <label>Содержание</label>
            <textarea name="content" id="content"></textarea>

            <label>Категория</label>
            <select name="category_id">
                <option value="">— Без категории —</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>

            <div class="post-actions">
                <button type="submit" class="btn btn-primary">Создать</button>
            </div>
        </form>
        
    </div>


<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
