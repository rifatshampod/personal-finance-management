# Form Requests

Form request classes centralize validation and authorization for HTTP handlers.

## Key Requests
- **TransactionRequest**: Validates income, expense, and transfer payloads, including attachment limits and destination account rules.
- **AccountRequest**: Ensures account creation/update includes required metadata such as name, type, and currency.
- **ObligationRequest & ObligationPaymentRequest**: Validate IOU creation and payment posting (amount bounds, direction, dates, and related accounts).
- **ProfileUpdateRequest**: Handles profile updates for authenticated users from Laravel Breeze.
- **Auth/**: Breeze-provided requests for login/registration flows.

## Usage
Controllers type-hint these requests to automatically apply validation before reaching business logic. Rules enforce data integrity and prevent invalid transfer destinations or payment amounts.
