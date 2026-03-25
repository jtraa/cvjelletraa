# CV Website – Jelle Traa
Laravel 11 · Filament 3 · NL/EN · PDF / PNG / DOCX downloads

---

## Requirements
- PHP 8.2+
- Composer
- MySQL / SQLite
- Node.js + npm (optional, only if you add Vite assets)

---

## Quick start

### 1. Create a new Laravel 11 project
```bash
composer create-project laravel/laravel cv-website
cd cv-website
```

### 2. Copy the files from this archive
Replace / merge the following folders into your fresh project:
- `app/`
- `bootstrap/app.php`
- `database/migrations/`
- `database/seeders/`
- `resources/views/`
- `resources/lang/`
- `routes/web.php`
- `composer.json` *(then run `composer install` again)*
- `public/images/` *(copy jelle.jpg here)*

### 3. Install extra packages
```bash
composer require filament/filament:"^3.2" \
    barryvdh/laravel-dompdf:"^2.2" \
    phpoffice/phpword:"^1.2"
```

### 4. Publish Filament
```bash
php artisan filament:install --panels
```
When asked for the panel ID enter: **admin**

### 5. Configure .env
```
APP_NAME="CV Jelle Traa"
APP_LOCALE=nl
DB_DATABASE=cv_website
DB_USERNAME=root
DB_PASSWORD=secret
```

### 6. Run migrations + seed
```bash
php artisan migrate
php artisan db:seed --class=CvSeeder
```

### 7. Create an admin user
```bash
php artisan make:filament-user
```

### 8. Link storage (for uploaded photos)
```bash
php artisan storage:link
```

### 9. Serve
```bash
php artisan serve
```

- **CV front page** → http://localhost:8000
- **Admin panel**   → http://localhost:8000/admin

---

## Features

| Feature | How it works |
|---|---|
| 🇳🇱 / 🇬🇧 language switch | Flag buttons top-right; locale stored in session |
| Download PDF | Server-side via `barryvdh/laravel-dompdf` |
| Download PNG | Client-side via `html2canvas` (no server needed) |
| Download DOCX | Server-side via `phpoffice/phpword` |
| Admin panel `/admin` | Filament 3 with 4 resources: Personal info, Work experience, Skills, Education |
| Drag-to-reorder | Work experience, skills and education support drag reordering in the admin |
| Photo upload | Upload via Filament, stored in `storage/app/public/photos` |

---

## Admin resources

| Resource | What you can edit |
|---|---|
| Persoonlijke info | Name, job title (NL+EN), contact details, profile text (NL+EN), photo |
| Werkervaring | Period, company, description (NL+EN), URL, tech stack, order |
| Vaardigheden | Category (NL+EN), items (pipe-separated), order |
| Educatie | Title (NL+EN), institution, period, learned (NL+EN), order |
# cvjelletraa
