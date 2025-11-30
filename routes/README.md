# Routes

Route definitions wire controllers and middleware for web, API, auth, and broadcasting channels.

## Key Files
- **web.php**: Authenticated UI routes for dashboard, CRUD resources (accounts, categories, counterparties, transactions, obligations), CSV export, reports view, and settings view.
- **auth.php**: Laravel Breeze authentication routes (login, registration, email verification, password reset).
- **api.php**: Placeholder for API routes using the `api` middleware group.
- **channels.php / console.php**: Broadcast and console route definitions (framework defaults, extend as needed).

## Usage
`web.php` routes are grouped under `auth` middleware. Resource controllers follow standard naming, simplifying URL generation via `route()` in views and controllers.
