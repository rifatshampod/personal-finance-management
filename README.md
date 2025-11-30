<p align="center">
  <h1>Personal Finance Management</h1>
  <p><em>Mobile-first Laravel app for tracking money, obligations, and day-to-day spending.</em></p>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Stack-Laravel%2011%20%7C%20Blade%20%7C%20Tailwind-blue" alt="Tech Stack" />
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License" />
  <img src="https://img.shields.io/badge/Status-Active-success" alt="Status" />
  <img src="https://img.shields.io/badge/Version-0.1.0-lightgrey" alt="Version" />
</p>

## Introduction
Personal Finance Management is a Laravel 11 application that helps individuals and households track accounts, categorize income and expenses, settle IOUs/obligations, and export data. It ships with a Blade/Tailwind UI, Laravel Breeze authentication, and API-ready models protected by per-user ownership scopes.

## Features
- 📱 Mobile-friendly layout with navigation tailored for quick entry
- 🔐 Authentication via Laravel Breeze with email verification and password reset
- 🧾 Track income, expenses, and transfers with optional file attachments
- 🗂️ Manage categories, counterparties, and multiple accounts with balances
- 🤝 Record IOUs/obligations, post payments, and update settlement status automatically
- 📤 Export recent transactions to CSV and throttle heavy export requests
- ⚙️ Per-user settings including default currency and dark mode toggle

## Use Cases & Examples
- **Logging daily spending**: add an expense transaction against your cash or bank account, select an expense category, and optionally attach a receipt.
- **Handling reimbursements**: record an obligation when someone owes you; as payments arrive, post them to update the remaining balance and mirror the flow in your transactions.
- **Moving money between accounts**: create a transfer that automatically posts paired income/expense legs linking the source and destination accounts.

```php
// Example: programmatically creating a transfer
$transferService->create(
    userId: (string) auth()->id(),
    sourceAccountId: $wallet->id,
    destinationAccountId: $savings->id,
    amount: 150.00,
    occurredAt: now(),
    notes: 'Move cash to savings'
);
```

## Tech Stack
- 🧰 **Backend:** PHP 8.2+, Laravel 11, Laravel Breeze, Sanctum
- 🎨 **Frontend:** Blade, Tailwind CSS, Alpine.js, Vite
- 🗄️ **Database:** MySQL/MariaDB (Eloquent models and migrations)
- 🧪 **Tooling:** Pest for tests, Laravel Pint/Larastan for quality checks

## Getting Started
### Prerequisites
- PHP 8.2+
- MySQL 8 or MariaDB 10.6+
- Node.js 18+

### Installation
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

### Configuration
Update `.env` with your database credentials and optional storage/mail settings:
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=finance
DB_USERNAME=app
DB_PASSWORD=secret
FILESYSTEM_DISK=local
```
Demo credentials (seeded): **demo@example.com / password**.

## Project Structure
```
app/                    # Domain models, HTTP controllers, services, policies
bootstrap/              # Laravel bootstrap and caching
config/                 # Framework and package configuration
database/               # Migrations, factories, seeders
public/                 # Public entrypoint and built assets
resources/              # Blade views, styles, Alpine entrypoint
routes/                 # Web/API/auth route definitions
storage/                # Logs, framework caches, file uploads
tests/                  # Pest feature and unit tests
```

## Contributing
1. Fork the repository and create a feature branch.
2. Follow PSR-12/Laravel conventions and add tests for new behavior.
3. Run `php artisan test` and ensure Pint/Larastan checks are clean.
4. Submit a PR with a clear summary of changes and testing performed.

## License
This project is licensed under the MIT License (see `composer.json`).
