# Tests

Pest tests cover authentication scaffolding and finance flows.

## Key Suites
- **Feature/TransactionsTest.php**: Verifies creating income transactions via HTTP endpoints.
- **Feature/OwnershipTest.php**: Ensures user ownership scope prevents cross-user access to accounts.
- **Feature/ProfileTest.php**: Confirms profile update and password change behavior from Breeze.
- **Unit/ExampleTest.php**: Placeholder unit test scaffold.

## Usage
Run `php artisan test` (or `./vendor/bin/pest`) to execute the suite. Tests use `RefreshDatabase` to isolate data and rely on model factories where available.
