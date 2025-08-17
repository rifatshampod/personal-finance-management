<?php

namespace App\Policies;

use App\Models\ObligationPayment;
use App\Models\User;

class ObligationPaymentPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, ObligationPayment $payment): bool { return $payment->user_id === $user->id; }
    public function create(User $user): bool { return true; }
    public function delete(User $user, ObligationPayment $payment): bool { return $payment->user_id === $user->id; }
}


