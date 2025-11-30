# Domain Models

Eloquent models represent finance entities and enforce per-user ownership.

## Key Models
- **Account**: Stores account metadata and exposes a computed `balance` derived from transaction income/expense totals.
- **Transaction**: Captures income, expenses, transfers (with `transfer_group`), optional attachments, and scopes for type/month filtering.
- **Category & Counterparty**: Taxonomy used to classify transactions and IOUs.
- **Obligation & ObligationPayment**: Represent IOUs with `remaining_amount` and related payment records that link to transactions.
- **Setting**: Per-user preferences such as default currency and dark mode.
- **Concerns/BelongsToUser & Scopes/OwnedByUserScope**: Attach authenticated ownership automatically and filter queries to the signed-in user.

## Usage
Models default to ULID primary keys and fillable attributes for mass assignment. `BelongsToUser` sets `user_id` on create and applies the ownership scope so controllers and services automatically operate on the caller's records.
