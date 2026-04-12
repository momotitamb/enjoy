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
- Router fix: parse_url() + fixed param passing (isset($matches[1]) ? $matches[1] : null)
- Abstract Controller with render(), auth(), adminOnly(), verifyCsrfToken()
- Layout system (header/footer) with active nav links
- spl_autoload_register autoloader
- Service Container with bind()/make() for Dependency Injection
- session_start() in public/index.php (global)
- CSRF token generated in public/index.php, verified in all POST/PUT/DELETE methods
- Validator class skeleton (data, errors, errors()) — methods not yet implemented

### OOP Concepts Covered
- Abstract classes, Interfaces, Traits
- Static methods, self:: vs static:: (late static binding)
- Class constants (STATUS_DRAFT, STATUS_PUBLISHED, ROLE_USER, ROLE_ADMIN)
- Singleton pattern, Repository pattern, Dependency Injection
- Type declarations, union types (array|false)
- Strict comparison (===)

### Authentication (COMPLETED)
- AuthController — loginForm(), login(), registerForm(), register(), logout()
- Sessions — user_id, user_email, user_name, user_role
- password_hash() / password_verify()
- session_regenerate_id(true) after login (before writing to session)
- Route protection — auth() for logged-in, adminOnly() for admins
- Views: auth/login.php, auth/register.php (no value attributes, no CSRF needed)

### Models
- Post — all(), find(), findBySlug(), create($title,$slug,$content,$user_id,$category_id=null),
  update(), delete(), getCategory(), allWithCategory($page,$perPage), allWithAuthor(),
  allWithRelations(), count()
- Category — all(), find(), create(), delete(), generateSlug(), getPostsCount()
  (uses ORDER BY created_at DESC, NOT GROUP BY)
- User — all(), find(), findByEmail(), create($name,$email,$password),
  update($name,$email,$id), delete(), getPostsCount()

### SQL
- CRUD with prepared statements
- JOIN queries (INNER JOIN, LEFT JOIN)
- Aggregate functions (COUNT, GROUP BY)
- Pagination with LIMIT/OFFSET (bindValue with PDO::PARAM_INT)
- QueryBuilder class — select(), where(), orderBy(), get()

### Frontend & Views
- Full CRUD for posts (index, show, create, edit, delete)
- Category pages (index with delete for admin, create form)
- User pages — index, show, edit (all complete)
- Auth pages — login, register
- Pagination with page numbers and prev/next
- Dark theme CSS — .post-card, .card, .card-title, .btn-link, .user-menu dropdown
- btn alignment fix: line-height on a.btn, button.btn
- Forms with PUT/DELETE method spoofing
- CSRF hidden field in all POST/PUT/DELETE forms
- Nav: user dropdown (name → logout on hover), auth links for guests
- Conditional rendering — buttons hidden for guests

### Controllers
- PostController — full CRUD, auth() on write methods, verifyCsrfToken() on store/update/destroy
- CategoryController — index(public), create/store/destroy (adminOnly + verifyCsrfToken)
- AuthController — login/register/logout, sessions, password hashing, session_regenerate_id
- UserController — index/show (auth), edit/update/destroy (adminOnly + verifyCsrfToken)

### Security
- CSRF protection on all mutating forms
- session_regenerate_id after login
- auth() and adminOnly() route protection
- password_hash / password_verify
- htmlspecialchars on output
- PDO prepared statements

## What's Left To Do

### IN PROGRESS
- [ ] Validator class — add required(), minLength(), email() methods and use in controllers
- [ ] Flash messages — show errors/success after redirect

### Project Completion
- [ ] Show created_at dates on posts and users
- [ ] Confirmation dialog on delete buttons (onclick confirm)
- [ ] Write README.md for GitHub
- [ ] Push to GitHub as portfolio project
- [ ] Integrate QueryBuilder into models (optional)
- [ ] Add SQL injection protection to QueryBuilder
- [ ] Add join() method to QueryBuilder

### Topics To Revisit (Marked Difficult)
- [ ] Container, make(), DI — review with Laravel comparison
- [ ] Magic methods __get, __set, __toString — practical examples
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
- CSRF token generated once in index.php, lives in $_SESSION['csrf_token']
- CategoryController has no repository — uses Category model directly
- AuthController NOT registered in Container (no DI needed)
- config/database.php is in .gitignore
- QueryBuilder needs SQL injection protection before production use
- MySQL via phpMyAdmin at http://localhost/phpmyadmin
- User roles: 'user' (default), 'admin' — checked via $_SESSION['user_role'] === 'admin'
- display_errors = 1 in index.php (dev only — remove before production)
- Post::create() param order: $title, $slug, $content, $user_id, $category_id=null
- Router passes params as: isset($matches[1]) ? $matches[1] : null

## Difficult Topics (Need Extra Attention)
- Container, DI, make() — student found difficult
- Magic methods __get, __set, __toString — postponed
- Any new syntax must be explained immediately with full context
