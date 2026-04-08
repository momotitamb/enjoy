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
- Do NOT commit without student request
- Do NOT ask "покажи что сделал" — read files yourself
- If explanation doesn't work — change approach, don't repeat the same thing
- Always explain new terms immediately (bind, factory, type hint, callable etc.)
- Break complex topics into small steps with verification of each
- Before starting any new topic — explain the theory: what it is, why it's needed, where it's used
- Periodically give practice tasks to reinforce topics covered

## Tech Stack
- PHP 8+ (no frameworks)
- MySQL + PDO
- CSS (dark theme)
- Server: `php -S localhost:8000 -t public`
- XAMPP on Windows (MySQL accessible via phpMyAdmin, not terminal)

## Project Structure
```
app/
  Controllers/   — PostController, AuthController (in progress)
  Core/          — Router, Database, Controller, Container, Model, QueryBuilder, Sluggable
  Core/Traits/   — LoggableTrait, TimestampableTrait
  Models/        — Post, Category, User
  Repositories/  — PostRepository, PostRepositoryInterface, RepositoryInterface
  Services/      — (empty, for future use)
views/
  layouts/       — header.php, footer.php
  posts/         — index, show, create, edit, slug
  categories/    — index.php, create.php
  auth/          — (to be created: login.php, register.php)
config/
  database.php   — DB credentials (not in git)
public/
  index.php      — entry point
  css/style.css
autoload.php     — spl_autoload_register (Core, Core/Traits, Controllers, Models, Services, Repositories)
bootstrap.php    — Container bindings (PostController only)
routes.php       — all routes
```

## Database Tables
- `posts` — id, title, slug, content, status (draft/published), category_id, user_id, created_at
- `categories` — id, name, slug, created_at
- `users` — id, name, email, password (VARCHAR 255), created_at
- Foreign keys: posts.category_id → categories.id, posts.user_id → users.id

## What's Been Implemented

### Core Architecture
- Singleton Database class with PDO
- Router with dynamic params {id}, {slug}, HTTP method spoofing (_method)
- Router fix: parse_url() to strip query string before matching
- Abstract Controller with render() and extract() for templates
- Layout system (header/footer) with active nav links
- spl_autoload_register autoloader (includes Core/Traits)
- Service Container with bind()/make() for Dependency Injection

### OOP Concepts Covered
- Abstract classes (Model base class with getTableName())
- Interfaces (RepositoryInterface, PostRepositoryInterface, Sluggable)
- Traits (LoggableTrait, TimestampableTrait)
- Static methods and self:: vs static:: (late static binding)
- Class constants (STATUS_DRAFT, STATUS_PUBLISHED, ROLE_USER, ROLE_ADMIN)
- Singleton pattern (Database)
- Repository pattern (PostRepository)
- Dependency Injection (controllers receive repo via constructor)

### Models
- Post — all(), find(), findBySlug(), create(), update(), delete(), getCategory(),
  allWithCategory($page=1, $perPage=5) with LIMIT/OFFSET pagination,
  allWithAuthor(), allWithRelations(), count()
- Category — all(), find(), create(), delete(), generateSlug(), getPostsCount()
- User — all(), find(), create(), delete(), getPostsCount()

### SQL
- CRUD with prepared statements
- JOIN queries (INNER JOIN, LEFT JOIN)
- Aggregate functions (COUNT, GROUP BY)
- Pagination with LIMIT/OFFSET (uses bindValue with PDO::PARAM_INT — important!)
- QueryBuilder class — select(), where(), orderBy(), get()

### Frontend
- Full CRUD for posts (index, show, create, edit, delete)
- Category pages (index with delete, create form)
- Category dropdown in post create form
- Pagination with page numbers and prev/next buttons
- Dark theme CSS with active nav links
- Forms with PUT/DELETE method spoofing

### Controllers
- PostController — full CRUD, uses PostRepositoryInterface via DI
- CategoryController — index, create, store, destroy (uses Category model directly, no repository)
- HomeController — DELETED, replaced by PostController::index() on route /

## What's Left To Do

### IN PROGRESS
- [ ] AuthController — structure created, needs implementation:
  - loginForm(), login(), registerForm(), register(), logout()
  - Sessions ($_SESSION)
  - password_hash() / password_verify()
  - Route protection (only logged in users can create/edit/delete posts)
  - Add routes to routes.php
  - Create views: auth/login.php, auth/register.php

### Project Completion
- [ ] Authentication (see above)
- [ ] Write README.md for GitHub
- [ ] Push to GitHub as portfolio project
- [ ] Integrate QueryBuilder into models (optional, replace raw SQL)
- [ ] Add SQL injection protection to QueryBuilder (placeholders)
- [ ] Add join() method to QueryBuilder

### Topics To Revisit (Marked Difficult)
- [ ] Container, make(), DI — review with Laravel comparison
- [ ] __get, __set, __toString — practical implementation postponed
- [ ] Caching and logging in pure PHP

### Week 4 Plan (Postponed)
- [ ] Algorithms in PHP (bubble sort, binary search, recursion)
- [ ] Git workflow (branches, merge, conflicts)
- [ ] Typical interview questions
- [ ] Return to renamer and maze.php tasks
- [ ] Linux basics (student asked about this)

### Week 3 (Remaining)
- [ ] See how Repository/DI/Container are implemented in Laravel

## Important Technical Notes
- PDO + LIMIT/OFFSET: must use bindValue($pos, $val, PDO::PARAM_INT) not execute([]) — strings cause SQL error
- CategoryController has no repository — uses Category model directly (simpler approach)
- AuthController should NOT be registered in Container (simple constructor, no DI needed)
- config/database.php is in .gitignore (contains credentials)
- QueryBuilder needs SQL injection protection before production use
- Users table has 8 seeded users with password '1111' (hashed with password_hash)
- MySQL accessible via phpMyAdmin at http://localhost/phpmyadmin (not terminal on Windows/XAMPP)

## Difficult Topics (Need Extra Attention)
- Container, DI, make() — student found difficult, needs review with Laravel comparison
- Magic methods __get, __set, __toString — postponed, needs practical examples
- Any new syntax must be explained immediately with full context
