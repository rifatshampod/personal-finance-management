# Services

Service classes encapsulate multi-step business workflows outside controllers.

## Key Services
- **TransactionService**: Handles creation/update/deletion of transactions, setting default dates and managing attachment storage cleanup.
- **TransferService**: Creates paired income/expense legs for account-to-account transfers within a database transaction.
- **ObligationService**: Creates obligations and records payments, generating matching transactions and updating settlement status.

## Usage
Inject services into controllers to keep request handlers concise. Each service wraps its operations in database transactions to maintain data consistency across related records and file storage.
