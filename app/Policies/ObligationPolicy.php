<?php

namespace App\Policies;

use App\Models\Obligation;
use App\Models\User;

class ObligationPolicy
{
    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Obligation $obligation): bool { return $obligation->user_id === $user->id; }
    public function create(User $user): bool { return true; }
    public function update(User $user, Obligation $obligation): bool { return $obligation->user_id === $user->id; }
    public function delete(User $user, Obligation $obligation): bool { return $obligation->user_id === $user->id; }
}


