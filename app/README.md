# App Layer

This directory contains the application core: HTTP controllers, form requests, policies, models, scopes, services, and view components that implement the finance workflows.

## Key Components
- **Http/**: Controllers and middleware powering web routes, plus validation via `Http/Requests`.
- **Models/**: Eloquent models (Accounts, Transactions, Obligations, etc.), user-ownership scope, and shared traits.
- **Services/**: Business operations like transfers, transaction lifecycle, and obligation payments.
- **Policies/**: Authorization rules protecting user-owned resources.
- **View/Components/**: Reusable Blade components for layout and navigation.

## Usage
The app layer enforces per-user ownership via `BelongsToUser` and `OwnedByUserScope`, so controllers and services automatically filter data for the authenticated user. Services encapsulate multi-step workflows (transfers, attachment handling, obligation payments) to keep controllers thin.
