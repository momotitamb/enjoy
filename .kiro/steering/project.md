---
inclusion: always
---

# PHP CMS Project — Context for AI Assistant

## Project Overview
A PHP CMS built from scratch without frameworks as a learning project. Pure OOP architecture with MVC pattern. Student is preparing for job search.

## Mentoring Approach
- Guide thinking with questions, do NOT provide ready solutions
- Read files automatically instead of asking student to show them
- Explain like a human, not documentation
- Full code examples with line-by-line breakdown when needed
- Use analogies for abstract concepts
- After each difficult topic — give practice task
- Student communicates in Russian

## Tech Stack
- PHP 8+ (no frameworks)
- MySQL + PDO
- CSS (dark theme)
- Server: `php -S localhost:8000 -t public`

## Project Structure
```
app/
  Controllers/   — HomeController, PostController
  Core/          — Router, Database, Controller, Container, Model, QueryBuilder, Sluggable
  Core/Traits/   — LoggableTrait, TimestampableTrait
  Models/        — Post, Category, User
  Repositories/  — PostRepository, PostRepositoryInterface, RepositoryInterface
  Services/      — (empty, for future use)
views/
  layouts/       — header.php, footer.php
  posts/         — index, show, create, edit, slug
config/
  database.php   — DB credentials (not in git)
public/
  index.php      — entry point
  css/style.css
autoload.php     — spl_autoload_register (Core, Core/Traits, Controllers, Models, Services, Repositories)
bootstrap.php    — Container bindings
routes.php       — all routes
```

## Database Tables
- `posts` — id, title, slug, content, status (draft/published), category_id, user_id, created_at
- `categories` — id, name, slug, created_at
- `users` — id, name, email, created_at

## What's Been Implemented

### Core Architecture
- Singleton Database class with PDO
- Router with dynamic params {id}, {slug}, HTTP method spoofing (_method)
- Abstract Controller with render() and extract() for templates
- Layout system (header/footer)
- spl_autoload_register autoloader
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
- Post — all(), find(), findBySlug(), create(), update(), delete(), getCategory(), allWithCategory(), allWithAuthor(), allWithRelations()
- Category — all(), find(), create(), delete(), generateSlug(), getPostsCount()
- User — all(), find(), create(), delete(), getPostsCount()

### SQL
- CRUD with prepared statements
- JOIN queries (INNER JOIN, LEFT JOIN)
- Aggregate functions (COUNT, GROUP BY)
- QueryBuilder class — select(), where(), orderBy(), get()

### Frontend
- Full CRUD for posts (index, show, create, edit, delete)
- Dark theme CSS
- Forms with PUT/DELETE method spoofing

## What's Left To Do

### Project Completion
- [ ] Integrate QueryBuilder into models (replace raw SQL)
- [ ] Add placeholders/security to QueryBuilder (SQL injection protection)
- [ ] Add join() method to QueryBuilder
- [ ] Category pages (list, create form, assign to post)
- [ ] Write README.md
- [ ] Push to GitHub as portfolio project

### Topics To Revisit (Marked Difficult)
- [ ] Container, make(), DI — review with Laravel comparison (Week 4)
- [ ] __get, __set, __toString — practical implementation postponed
- [ ] Caching and logging in pure PHP

### Week 4 Plan (Partially Done)
- [ ] Algorithms in PHP (bubble sort, binary search, recursion)
- [ ] Git workflow (branches, merge, conflicts)
- [ ] Typical interview questions
- [ ] Return to renamer and maze.php tasks

### Week 3 (Remaining)
- [ ] See how Repository/DI/Container are implemented in Laravel

## Important Notes
- Do NOT commit frequently without student request
- Do NOT touch code without being asked
- Student knows SQL well — no need to explain basic concepts
- QueryBuilder needs SQL injection protection before production use
- config/database.php is in .gitignore (contains credentials)
