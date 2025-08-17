## Personal Finance Tracker (Laravel 11)

Mobile-first, multi-user personal finance tracker built with Laravel 11, Blade, Tailwind CSS, and Alpine.js.

### Features

-   Auth via Laravel Breeze with email verification and password reset
-   Track accounts, transactions (income, expense, transfers), categories, counterparties
-   IOUs/Obligations with payments and auto-updated status
-   Per-user settings including dark mode
-   CSV export, simple dashboard, and mobile bottom navigation
-   API-ready via Sanctum

### Requirements

-   PHP 8.2+
-   MySQL 8 / MariaDB 10.6+
-   Node 18+

### Setup

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

Login with demo user:

-   Email: demo@example.com
-   Password: password

### Tests

```bash
php artisan test
```

### Screenshots

![Dashboard](docs/screenshots/dashboard.png)
![Accounts](docs/screenshots/accounts.png)
![Add Transaction](docs/screenshots/add-transaction.png)
![IOUs](docs/screenshots/ious.png)
