# Deployment Checklist

This checklist is for the Upturn Business Solutions Laravel 11 + Filament 3 project.

## Before Deploying

- Confirm `.env` values are correct for the target environment:
  `APP_URL`, `DB_*`, `MAIL_*`, `QUEUE_CONNECTION`, `SESSION_DRIVER`, `CACHE_STORE`.
- Confirm the database is backed up before schema changes.
- Review pending migrations with `php artisan migrate:status`.
- Run tests locally with `php artisan test`.
- Build frontend assets with `npm run build`.

## Deploy Steps

- Pull the latest code to the server.
- Install PHP dependencies:
  `composer install --no-dev --optimize-autoloader`
- Install frontend dependencies if needed:
  `npm ci`
- Build production assets:
  `npm run build`
- Run database migrations:
  `php artisan migrate --force`
- Create the public storage symlink if it does not exist:
  `php artisan storage:link`
- Clear old caches:
  `php artisan optimize:clear`
- Rebuild Laravel caches:
  `php artisan config:cache`
- Rebuild Laravel routes:
  `php artisan route:cache`
- Rebuild compiled views:
  `php artisan view:cache`
- Restart queue workers if queues are running:
  `php artisan queue:restart`

## After Deploying

- Load the public website home page: `/`
- Check the public contact page: `/contact`
- Check the careers page: `/careers`
- Check the admin login: `/admin`
- Check the HR login: `/hr`
- Submit a test inquiry and confirm it is stored in the `inquiries` table.
- Submit a test job application and confirm it is stored in the `applications` table.
- Confirm uploaded resumes are being stored on the `private` disk.
- Confirm email notifications are reaching the expected mail driver or inbox.

## Laragon Local Checklist

- Use the Laragon PHP binary or Laragon terminal if `php` is not on `PATH`.
- Typical local PHP path in this workspace:
  `D:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe`
- If you pull new code and the app throws `Unknown column` errors, run:
  `php artisan migrate`
- If the public UI looks stale after frontend changes, run:
  `npm install`
- Then rebuild assets:
  `npm run build`
- If Filament panels or providers seem stale, run:
  `php artisan optimize:clear`

## Common Recovery Checks

- `SQLSTATE[42S22] Unknown column ...`
  Run `php artisan migrate` or `php artisan migrate --force` on the target environment.
- `Vite manifest not found`
  Run `npm install` and `npm run build`.
- Public files not loading from `/storage`
  Run `php artisan storage:link`.
- Panel routes missing or stale
  Run `php artisan optimize:clear`.
