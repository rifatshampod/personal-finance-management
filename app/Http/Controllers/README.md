# HTTP Controllers

Controllers expose the personal finance workflows to authenticated users.

## Key Controllers
- **DashboardController**: Aggregates balances, monthly income/expenses, and open obligations for the landing dashboard.
- **AccountController / CategoryController / CounterpartyController**: CRUD endpoints for core reference data.
- **TransactionController**: Lists and filters transactions, posts income/expense entries, and delegates transfers to `TransferService`.
- **TransactionExportController**: Streams CSV exports for recent transactions with throttling.
- **ObligationController & ObligationPaymentController**: Manage IOUs/obligations, recording payments that also create matching transactions.
- **ProfileController**: User profile and password updates via Laravel Breeze scaffolding.

## Usage
Routes in `routes/web.php` wrap these controllers with `auth` middleware. Controllers depend on form requests for validation and services for multi-step operations (transfers, obligation payments). Authorization policies protect account-level actions before updates/deletes.
