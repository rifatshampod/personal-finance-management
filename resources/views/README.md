# Views

Blade templates render the mobile-first UI for accounts, transactions, obligations, and settings.

## Key Areas
- **layouts/**: Base layout (`app.blade.php`) with navigation and Vite asset loading.
- **components/**: Shared UI fragments such as navigation and form inputs.
- **dashboard/**: Summary cards for balances, monthly flows, and outstanding obligations.
- **accounts/, categories/, counterparties/**: CRUD screens for reference data.
- **transactions/**: Listing, filters, create/edit forms, and CSV export link.
- **obligations/**: IOU management with payment flows.
- **settings/** & **profile/**: User preferences and profile management pages.

## Usage
Views rely on data supplied by controllers and Eloquent relationships. Tailwind utility classes drive styling, while Alpine.js powers lightweight interactivity loaded via `resources/js/app.js`.
