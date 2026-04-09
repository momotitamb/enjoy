<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">

        <nav>
            <div class="container">
                <a href="/" class="<?= $_SERVER['REQUEST_URI'] === '/' ? 'active' : '' ?>">Главная</a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/users" class="<?= $_SERVER['REQUEST_URI'] === '/users' ? 'active' : '' ?>">Пользователи</a>
                <?php endif; ?>
                
                <a href="/categories" class="<?= str_starts_with($_SERVER['REQUEST_URI'], '/categories') ? 'active' : '' ?>">Категории</a>
            
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/posts/create">Новый пост</a>
                    
                    <div class="user-menu">
                        <span><?= $_SESSION['user_name'] ?></span>   
                        <div class="user-dropdown">

                            <form action="/logout" method="POST" class="inline">
                                <button type="submit" class="btn-link">Выйти</button>
                            </form>
                            
                        </div>     
                    </div>

                
                <?php else: ?>
                    <a href="/login">Войти</a>
                    <a href="/register">Регистрация</a>
                <?php endif; ?>
            </div>            
        </nav>

    </div>

    <main>
        <div class="container">
