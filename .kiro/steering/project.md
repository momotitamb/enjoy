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
- After each difficult topic — give practice task
- Student communicates in Russian
- Do NOT touch code without being explicitly asked
- Remind student to commit regularly at logical checkpoints
- Do NOT ask "покажи что сделал" — read files yourself
- If explanation doesn't work — change approach, don't repeat the same thing
- Always explain new terms immediately (bind, factory, type hint, callable etc.)
- Break complex topics into small steps with verification of each
- Before starting any new topic — explain the theory: what it is, why it's needed, where it's used
- Periodically give practice tasks to reinforce topics covered — do this frequently
- Do NOT show ready code solutions unless student explicitly asks

## Tech Stack
- PHP 8+ (no frameworks)
- MySQL + PDO
- CSS (dark theme)
- Server: `php -S localhost:8000 -t public`
- XAMPP on Windows (MySQL accessible via phpMyAdmin, not terminal)

## Project Structure
```
app/
  Controllers/   — PostController, AuthController, UserController
  Core/          — Router, Database, Controller, Container, Model, QueryBuilder, Sluggable
  Core/Traits/   — LoggableTrait, TimestampableTrait
  Models/        — Post, Category, User
  Repositories/  — PostRepository, PostRepositoryInterface, RepositoryInterface
  Services/      — (empty, for future use)
views/
  layouts/       — header.php, footer.php
  posts/         — index, show, create, edit, slug
  categories/    — index.php, create.php
  auth/          — login.php, register.php
  users/         — index.php, show.php, edit.php (in progress)
config/
  database.php   — DB credentials (not in git)
public/
  index.php      — entry point (session_start() here)
  css/style.css
autoload.php     — spl_autoload_register (Core, Core/Traits, Controllers, Models, Services, Repositories)
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
- Router fix: parse_url() to strip query string before matching
- Abstract Controller with render(), auth(), adminOnly()
- Layout system (header/footer) with active nav links
- spl_autoload_register autoloader (includes Core/Traits)
- Service Container with bind()/make() for Dependency Injection
- session_start() in public/index.php (global, runs on every request)

### OOP Concepts Covered
- Abstract classes (Model base class with getTableName())
- Interfaces (RepositoryInterface, PostRepositoryInterface, Sluggable)
- Traits (LoggableTrait, TimestampableTrait)
- Static methods and self:: vs static:: (late static binding)
- Class constants (STATUS_DRAFT, STATUS_PUBLISHED, ROLE_USER, ROLE_ADMIN)
- Singleton pattern (Database)
- Repository pattern (PostRepository)
- Dependency Injection (controllers receive repo via constructor)

### Authentication (COMPLETED)
- AuthController — loginForm(), login(), registerForm(), register(), logout()
- Sessions ($_SESSION) — user_id, user_email, user_name, user_role
- password_hash() / password_verify()
- Route protection — auth() for logged-in users, adminOnly() for admins
- Views: auth/login.php, auth/register.php
- Nav: shows user name with dropdown logout, login/register links when guest

### Models
- Post — all(), find(), findBySlug(), create(), update(), delete(), getCategory(),
  allWithCategory($page, $perPage), allWithAuthor(), allWithRelations(), count()
- Category — all(), find(), create(), delete(), generateSlug(), getPostsCount()
- User — all(), find(), findByEmail(), create($name,$email,$password), update($name,$email,$id),
  delete(), getPostsCount()

### SQL
- CRUD with prepared statements
- JOIN queries (INNER JOIN, LEFT JOIN)
- Aggregate functions (COUNT, GROUP BY)
- Pagination with LIMIT/OFFSET (bindValue with PDO::PARAM_INT)
- QueryBuilder class — select(), where(), orderBy(), get()

### Frontend
- Full CRUD for posts (index, show, create, edit, delete)
- Category pages (index with delete, create form)
- User pages — index.php done, show.php and edit.php in progress
- Pagination with page numbers and prev/next
- Dark theme CSS — .post-card, .card, .btn-link, .user-menu dropdown
- Forms with PUT/DELETE method spoofing
- Nav: user dropdown (name → logout on hover), auth links for guests

### Controllers
- PostController — full CRUD, auth() on write methods, uses PostRepositoryInterface via DI
- CategoryController — index, create, store, destroy (uses Category model directly)
- AuthController — login/register/logout, sessions, password hashing
- UserController — index(auth), show(auth), edit(adminOnly), update(adminOnly), destroy(adminOnly)

## What's Left To Do

### IN PROGRESS
- [ ] UserController views — fix show.php (remove form, display only), create edit.php
- [ ] Users nav link — show only for logged-in users
- [ ] Fix users/index.php — add show link, wrap delete in admin check, fix CSS class

### Project Completion
- [ ] При создании поста записывать user_id из сессии в posts.user_id
- [ ] Write README.md for GitHub
- [ ] Push to GitHub as portfolio project
- [ ] Integrate QueryBuilder into models (optional)
- [ ] Add SQL injection protection to QueryBuilder
- [ ] Add join() method to QueryBuilder

### Topics To Revisit
- [ ] Container, make(), DI — review with Laravel comparison
- [ ] __get, __set, __toString — postponed
- [ ] Caching and logging in pure PHP

### After Project (Job Prep)
- [ ] Algorithms in PHP (bubble sort, binary search, recursion) — algorithms.php exists
- [ ] Git workflow (branches, merge, conflicts)
- [ ] Typical interview questions
- [ ] Return to renamer and maze.php tasks
- [ ] Linux basics
- [ ] See how Repository/DI/Container are implemented in Laravel

## Important Technical Notes
- PDO + LIMIT/OFFSET: must use bindValue($pos, $val, PDO::PARAM_INT)
- session_start() only in public/index.php — do NOT add it anywhere else
- CategoryController has no repository — uses Category model directly
- AuthController NOT registered in Container (no DI needed)
- config/database.php is in .gitignore
- QueryBuilder needs SQL injection protection before production use
- Users table has seeded users with password '1111' (hashed), id=1 is admin (John Doe)
- MySQL via phpMyAdmin at http://localhost/phpmyadmin
- User roles: 'user' (default), 'admin' — stored as string in DB, checked via $_SESSION['user_role'] === 'admin'

## Difficult Topics (Need Extra Attention)
- Container, DI, make() — student found difficult
- Magic methods __get, __set, __toString — postponed
- Any new syntax must be explained immediately with full context
