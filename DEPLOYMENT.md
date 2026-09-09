# cPanel Production Deployment

This package is **deployment-ready**. No application code, routes, database logic,
design, or behaviour has been changed. The only production concerns addressed are:
public-asset loading, `.htaccess`, security hardening, permissions, and the
production `.env`.

---

## 1. What was changed vs. the source project

| File | Change | Reason |
|------|--------|--------|
| `.htaccess` (project root) | Rewrites all requests into the `/public` directory so that all static assets (CSS, JS, fonts, images) inside `/public` are served directly by Apache/LiteSpeed, while routes go to Laravel's front controller. | The previous `RewriteCond %{DOCUMENT_ROOT}` check failed on cPanel/LiteSpeed and caused static assets to drop into root `index.php`. The universal rewrite ensures reliable loading across all cPanel environments (main domains, addon domains, subdomains). |
| `index.php` (project root) | Added safe MIME-aware streaming fallback for static assets under Apache/LiteSpeed. | If a static asset is ever routed to root `index.php`, it now directly streams the file with the proper `Content-Type` instead of exiting with 0 bytes (`return false`). |
| `.env` | New production file: `APP_ENV=production`, `APP_DEBUG=false`, `LOG_LEVEL=error`, placeholder `APP_URL` + DB credentials. `APP_KEY` kept from source. | Production configuration. Fill in the placeholders (section 3). |
| `vendor/` | Rebuilt with `composer install --no-dev --optimize-autoloader`. Dev-only packages (debugbar, phpunit, collision, sail, faker, pint, ignition, whoops) removed. | Smaller, faster, smaller attack surface. |
| Runtime junk removed | `storage/logs/*`, `storage/framework/{cache,sessions,views}/*`, `bootstrap/cache/*.php`, `amplelab.zip`, `error_log`, dev `.env`. | Clean package. `bootstrap/cache` is rebuilt automatically on first request. |

Everything else (`app/`, `routes/`, `config/`, `database/`, `resources/`,
`public/` assets, `index.php`, `public/index.php`, `.user.ini`, `php.ini`) is
**byte-for-byte the original**.

---

## 2. Upload & extract

1. In cPanel **File Manager**, go to the folder that is (or will be) the site's
   document root — for the main domain that is usually `public_html`.
2. Upload this ZIP and **Extract** it there. You should end up with
   `public_html/.htaccess`, `public_html/index.php`, `public_html/app/`,
   `public_html/public/`, etc.

### Recommended (most secure) alternative — point the domain at `/public`
If cPanel lets you set the **Document Root** for the domain
(*Domains → manage → Document Root*), extract the package one level **above**
`public_html` (e.g. `/home/USER/amplelab`) and set the Document Root to
`/home/USER/amplelab/public`. The app then works with **no reliance on the
root `.htaccess`** and nothing but `/public` is web-reachable. Both layouts are
supported by this package with zero code changes.

---

## 3. Configure `.env`

Edit `.env` in the extracted root and set:

```
APP_URL=https://your-real-domain.com
DB_DATABASE=your_cpanel_db
DB_USERNAME=your_cpanel_db_user
DB_PASSWORD=your_cpanel_db_password
```

- Keep `APP_ENV=production` and `APP_DEBUG=false`.
- (Optional) rotate the app key: `php artisan key:generate` — only do this on a
  fresh install; it invalidates existing encrypted values / sessions.
- Import your database via **phpMyAdmin** and attach the DB user with **All
  Privileges** in *MySQL Databases*.

---

## 4. Permissions

From the account's SSH/terminal at the project root:

```bash
bash set-permissions.sh
```

Or manually in File Manager:

- Directories: `755`
- Files: `644`
- `storage/` and `bootstrap/cache/` (recursive): `775` (or `755` if PHP runs as
  your user, which is the cPanel default)
- `.env`: `600`

---

## 5. Optimise (run after `.env` and DB are set)

From the project root over SSH:

```bash
php artisan storage:link         # if you use the storage disk (safe to run)
php artisan config:cache
php artisan route:cache           # skip if it errors on a route closure
php artisan view:cache
php artisan event:cache
```

To undo before a redeploy: `php artisan optimize:clear`.

No SSH? The app runs fine without these caches; they are performance only.

---

## 6. Verify assets

Open the site, then check DevTools → Network:

- `https://your-domain/assets/css/style.css` → **200**, `Content-Type: text/css`
- `https://your-domain/welcome/...`, `/admin/app-assets/...`, `/fonts/...`,
  `/medies/...`, `/favicon.ico` → **200**
- `https://your-domain/.env` → **403 / 404** (must NOT download)
- `https://your-domain/storage/logs/laravel.log` → **403 / 404**

If CSS/JS still 404: confirm `mod_rewrite` is enabled and `AllowOverride All`
is set for the docroot (default on cPanel/LiteSpeed), or use the
point-at-`/public` layout from section 2.
