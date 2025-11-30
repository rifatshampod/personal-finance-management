# Database

Migrations, factories, and seeders define the schema and demo data for personal finance tracking.

## Key Assets
- **migrations/**: Tables for users/auth tokens, accounts, categories, counterparties, transactions (with transfer links and attachments), obligations, obligation payments, and per-user settings.
- **factories/**: Test/data factories for core models (see `database/factories`).
- **seeders/DatabaseSeeder.php**: Creates a demo user, default settings, sample accounts, categories, counterparties, random recent transactions, and example obligations.

## Usage
Run `php artisan migrate --seed` to create the schema and load demo data. ULID primary keys and ownership scopes allow safe seeding without collisions between test runs.
