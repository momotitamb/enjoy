# PHP CMS

A CMS built from scratch in pure PHP without frameworks as a learning project.
Pure OOP architecture with MVC pattern.

CMS написанный с нуля на чистом PHP без фреймворков в учебных целях.
Чистая ООП архитектура с паттерном MVC.

## Features / Возможности

- Full CRUD for posts, categories, users
- Authentication — register, login, logout, sessions
- Role system — user / admin
- Route protection via `auth()` and `adminOnly()`
- CSRF protection on all mutating forms
- Flash messages — success / error
- Form validation with custom Validator class
- Pagination for posts
- URL slugs for posts
- Dark theme UI

---

- Полный CRUD для постов, категорий, пользователей
- Аутентификация — регистрация, вход, выход, сессии
- Система ролей — user / admin
- Защита маршрутов через `auth()` и `adminOnly()`
- CSRF защита на всех формах
- Flash сообщения — success / error
- Валидация форм через собственный класс Validator
- Пагинация постов
- URL slugs для постов
- Тёмная тема

## OOP Concepts / ООП концепции

Abstract classes, Interfaces, Traits, Singleton, Repository pattern,
Dependency Injection, Service Container, Constants, Static methods, Union types

## Requirements / Требования

- PHP 8.0+
- MySQL

## Setup / Установка

```bash
php -S localhost:8000 -t public
