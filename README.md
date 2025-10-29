# Vanilla PHP MVC (No Framework) – Router + MySQL + jQuery + Docker

A small vanilla PHP 8.x app following PSR-4 autoloading with a simple Router, MVC-ish structure, MySQL (mysqli), and a minimal jQuery UI. It includes a social feed-style Home page with AJAX filtering (group/date), modal Create/Edit, and inline Delete – all without full-page reloads.

## Features
- PSR-4 autoload (`App\\` and `Core\\`)
- Public front controller (`public/index.php`) and Apache rewrite
- Simple Router supporting GET/POST and array handlers: `['home', 'index']`
- Core `Database` (mysqli singleton) and base `Model` (find/all/delete/insert/update)
- Example domain models: `Post`, `Person`, `Group`
- Home feed as cards with View/Edit/Delete actions and a modal form for create/edit
- AJAX filtering by group and date on Home (no reload)
- SQL schema + mock data import via endpoint (`/migrate`)
- Dockerized (php:8.3-apache, mysql:8, phpMyAdmin)

## Project Structure
```
postAssesmentTask/
├─ app/
│  ├─ Controllers/
│  │  ├─ HomeController.php
│  │  ├─ PostsController.php
│  │  ├─ PersonController.php
│  │  └─ GroupController.php
│  ├─ Models/
│  │  ├─ Post.php
│  │  ├─ Person.php
│  │  └─ Group.php
│  └─ Views/
│     ├─ home/
│     │  ├─ index.php
│     │  ├─ _grid.php
│     │  └─ _post_modal.php
│     ├─ persons/index.php
│     ├─ groups/index.php
│     └─ posts/view.php
├─ core/
│  ├─ Router.php
│  ├─ Controller.php
│  ├─ Model.php
│  └─ Database.php
├─ routes/web.php
├─ public/
│  ├─ index.php
│  └─ .htaccess
├─ assets/
│  ├─ css/app.css
│  └─ js/app.js
├─ config/database.php
├─ database/schema.sql
├─ Dockerfile
├─ docker-compose.yml
└─ composer.json
```

## Requirements
- PHP 8.2+ (or Docker)
- MySQL 8.x
- Composer 2.x
- Apache with `mod_rewrite` enabled (or Docker)


### Clone and Run (Manual)
1. Clone the repository:
   ```bash
   git clone https://github.com/TadasBaltru/postAssigment
   cd postAssigment
   ```
2. Install PHP autoloads:
   ```bash
   composer install
   composer dump-autoload -o
   ```
3. Configure Apache as shown above (Alias to `public/`).
4. Configure DB in `config/database.php` (or use the defaults).
5. Create the database (if not using Docker) and seed via endpoint:
   - Make sure MySQL is running and credentials in `config/database.php` are correct
   - Visit `http://localhost/postAssigment/migrate` once to import `database/schema.sql`
6. Open the app at `http://localhost/postAssigment/`.

Notes:
- The container serves `public/` as DocumentRoot.
## Manual Setup (Apache on Windows/WAMP)

Example:
```apache
# Serve the app
Alias /postAssigment "D:/LearningApps/postAssigment/public"
<Directory "D:/LearningApps/postAssigment/public">
    Options -Indexes -MultiViews +FollowSymLinks
    AllowOverride All
    Require local
    DirectoryIndex index.php
</Directory>

## Configuration
- DB credentials in `config/database.php` (defaults for Docker):
  ```php
  return [
      'host' => getenv('DB_HOST') ?: 'db',
      'port' => (int) (getenv('DB_PORT') ?: 3306),
      'database' => getenv('DB_NAME') ?: 'postass',
      'username' => getenv('DB_USER') ?: 'postass',
      'password' => getenv('DB_PASSWORD') ?: 'postass',
      'charset' => 'utf8mb4',
  ];
  ```

## Autoload
Install vendor autoload once, then dump when classes change:
```bash
composer install
composer dump-autoload -o
```

## Routes (array handlers only)
Defined in `routes/web.php`:
```php
$router->get('/', ['home', 'index']);                // Home feed (cards + modal create/edit)
$router->get('/posts/{id}/view', ['posts', 'view']); // Single post view

// AJAX endpoints used by the UI
$router->post('/posts/store', ['posts', 'store']);
$router->post('/posts/{id}/update', ['posts', 'update']);
$router->post('/posts/{id}/delete', ['posts', 'delete']);

// Utilities
$router->get('/persons', ['person', 'index']);
$router->get('/groups', ['group', 'index']);
$router->get('/migrate', ['db', 'migrate']); // imports database/schema.sql
```

## Home Feed (UI/UX)
- Cards show: title (or top of content), first ~15 words of content, author (name surname), author’s group at that post date, and date.
- Create/Edit is done in a modal (jQuery). Each card has inline actions: View, Edit, Delete.
- Filters above the feed (Group, Date) update the grid via AJAX without reloading the page.

AJAX endpoints used by the feed:
- GET `/?partial=1&group_id=&date=` → returns grid HTML only (partial)
- POST `/posts/store` → JSON `{ ok|Success: bool, id?, error? }`
- POST `/posts/{id}/update` → JSON `{ ok|Success: bool, id?, error? }`
- POST `/posts/{id}/delete` → JSON `{ ok|Success: bool, id?, error? }`

## Database and Models
- `Core\\Database` – mysqli singleton
- `Core\\Model` – base with `find`, `all`, `delete`, `insert`, `update`
- `App\\Models\\Post::all(array $filters = [])` accepts optional `group_id` and `date` for filtering and joins to enrich rows with person/group info (based on `valid_from`).
- Schema is in `database/schema.sql`. Use `/migrate` to import it.

## Coding Standards
- PHP files use `declare(strict_types=1);`
- PSR-12 style and PSR-4 autoloading
- No frameworks

## Troubleshooting
- If you see a directory index instead of the app:
  - Ensure DocumentRoot points to `public/` and `AllowOverride All` is set.
  - Verify `.htaccess` exists in `public/` and `mod_rewrite` is enabled.
- If AJAX updates don’t show immediately, ensure:
  - Endpoints return JSON with `ok: true` or `Success: true`.
  - The UI JS (`assets/js/app.js`) calls `loadCards()` after create/update/delete.


