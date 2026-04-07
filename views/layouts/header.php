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
            <a href="/" class="<?= $_SERVER['REQUEST_URI'] === '/' ? 'active' : '' ?>">Главная</a>
            <a href="/categories" class="<?= str_starts_with($_SERVER['REQUEST_URI'], '/categories') ? 'active' : '' ?>">Категории</a>
        </nav>
    </div>

    <main>
        <div class="container">
