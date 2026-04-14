---
inclusion: always
---

# PHP CMS Project — Context for AI Assistant

## Project Overview
A PHP CMS built from scratch without frameworks as a learning project. Pure OOP architecture with MVC pattern. Student is preparing for job search.

## Mentoring Approach (CRITICAL - ALWAYS FOLLOW)
- Guide thinking with questions, do NOT provide ready solutions
- Read files automatically instead of asking student to show them
- Explain like a human, not documentation
- Full code examples with line-by-line breakdown ONLY when student is stuck
- Use analogies for abstract concepts
- After each difficult topic — give practice task, do this frequently
- Student communicates in Russian
- Do NOT touch code without being explicitly asked
- Remind student to commit regularly at logical checkpoints
- Do NOT ask "покажи что сделал" — read files yourself
- If explanation doesn't work — change approach, don't repeat the same thing
- Always explain new terms immediately (bind, factory, type hint, callable etc.)
- Break complex topics into small steps with verification of each
- Before starting any new topic — explain the theory: what it is, why it's needed, where it's used
- Do NOT show ready code solutions unless student explicitly asks
- Do NOT give unnecessary hints — if student asks a direct question, answer it directly without extra suggestions they didn't ask for
- "ok" or "go" from student means "готово, идём дальше" — proceed to next step without asking for confirmation

## Tech Stack
- PHP 8+ (no frameworks)
- MySQL + PDO
- CSS (dark theme)
- Server: `php -S localhost:8000 -t public`
- XAMPP on Windows (MySQL accessible via phpMyAdmin, not terminal)

## Project Structure
```
app/
  Controllers/   — PostController, AuthController, UserController, CategoryController
  Core/          — Router, Database, Controller, Container, Model, QueryBuilder, Sluggable, Validator
  Core/Traits/   — LoggableTrait, TimestampableTrait
  Models/        — Post, Category, User
  Repositories/  — PostRepository, PostRepositoryInterface, RepositoryInterface
  Services/      — (empty, for future use)
views/
  layouts/       — header.php, footer.php
  posts/         — index, show, create, edit, slug
  categories/    — index.php, create.php
  auth/          — login.php, register.php
  users/         — index.php, show.php, edit.php
config/
  database.php   — DB credentials (not in git)
public/
  index.php      — entry point (session_start() + CSRF token generation here)
  css/style.css
autoload.php     — spl_autoload_register
bootstrap.php    — Container bindings (PostController only)
routes.php       — all routes
```

## Database Tables
- `posts` — id, title, slug, content, status (draft/published), category_id, user_id, created_at
- `categories` — id, name, slug, created_at
- `users` — id, name, email, password (VARCHAR 255), role (user/admin), created_at
- Foreign keys: posts.category_id → categories.id, posts.user_id → users.id

## What's Been Implemented

### Core Architecture
- Singleton Database class with PDO
- Router with dynamic params {id}, {slug}, HTTP method spoofing (_method)
- Abstract Controller with render(), auth(), adminOnly(), verifyCsrfToken(), setFlash(), getFlash()
- Layout system (header/footer) with active nav links
- spl_autoload_register autoloader
- Service Container with bind()/make() for Dependency Injection
- session_start() in public/index.php (global)
- CSRF protection on all mutating forms
- Validator class — required(), minLength(), email(), fails(), errors()
- Flash messages — setFlash/getFlash in Controller, displayed in header.php
- Form repopulation on error via $_SESSION['old']

### OOP Concepts Covered
- Abstract classes, Interfaces, Traits
- Static methods, self:: vs static:: (late static binding)
- Class constants, Singleton, Repository pattern, Dependency Injection
- Type declarations, union types, strict comparison
- Fluent interface (method chaining) — Validator
- Container/DI — разобрали полностью: bind создаёт схему, make исполняет
- Abstractions vs concrete implementations — разобрали

### Authentication (COMPLETED)
- register() — валидация, проверка email на уникальность, автологин после регистрации, repopulate form
- login() — валидация, flash на ошибку, session_regenerate_id
- logout(), route protection — auth(), adminOnly()

### Models (COMPLETED)
- Post, Category, User — полный CRUD + relations

### Controllers (COMPLETED)
- PostController — CRUD, adminOnly на edit/update/destroy, валидация в store/update, flash везде
- CategoryController — index(public), store/destroy (adminOnly), валидация, flash
- AuthController — полная аутентификация с валидацией и flash
- UserController — index/show (auth), edit/update/destroy (adminOnly), валидация, flash

### Security (COMPLETED)
- CSRF на всех мутирующих формах
- session_regenerate_id после логина
- auth() и adminOnly() защита маршрутов
- password_hash / password_verify
- htmlspecialchars на выводе
- PDO prepared statements
- isset() проверки перед $_SESSION['user_role'] во вьюхах

### Frontend (COMPLETED)
- Полный CRUD вьюхи для постов, категорий, пользователей
- Даты created_at на постах (все) и пользователях (только для админа)
- Подтверждение удаления — onsubmit confirm на всех формах удаления
- Flash сообщения — alert-success / alert-error в header.php
- Repopulate форм регистрации через $_SESSION['old']

## What's Left To Do

### Next Session — Continue Here
- [ ] Магические методы __get, __set, __toString — начали __toString, не закончили
- [ ] Push проекта на GitHub
- [ ] Алгоритмы — algorithms.php (bubble sort, binary search, рекурсия)
- [ ] Git workflow — ветки, merge, конфликты
- [ ] Нарисовать схему проекта + цепочку Container→Router→Controller (студент просил)

### Postponed (не срочно, вернуться позже)
- [ ] Подготовка к интервью
- [ ] Linux основы
- [ ] Задачи renamer и maze.php — незаконченные

### Optional Project Improvements
- [ ] Integrate QueryBuilder into models
- [ ] Add SQL injection protection to QueryBuilder
- [ ] Add join() method to QueryBuilder

### After Project (Job Prep)
- [ ] See how Repository/DI/Container are implemented in Laravel
- [ ] Caching and logging in pure PHP

## Important Technical Notes
- PDO + LIMIT/OFFSET: must use bindValue($pos, $val, PDO::PARAM_INT)
- session_start() only in public/index.php — do NOT add it anywhere else
- CSRF token generated once in index.php, lives in $_SESSION['csrf_token']
- CategoryController has no repository — uses Category model directly
- AuthController NOT registered in Container (no DI needed)
- config/database.php is in .gitignore
- MySQL via phpMyAdmin at http://localhost/phpmyadmin
- User roles: 'user' (default), 'admin' — checked via $_SESSION['user_role'] === 'admin'
- display_errors = 1 in index.php (dev only — remove before production)
- Post::create() param order: $title, $slug, $content, $user_id, $category_id=null
- Router passes params as: isset($matches[1]) ? $matches[1] : null
- $_SESSION['old'] used for form repopulation in register — unset after successful registration
- Services/ folder is intentionally empty — planned for Service Layer pattern

## Difficult Topics (Need Extra Attention)
- Magic methods __get, __set, __toString — IN PROGRESS, start here next session
- Any new syntax must be explained immediately with full context
