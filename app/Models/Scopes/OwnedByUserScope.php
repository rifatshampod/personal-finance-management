<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class OwnedByUserScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $userId = Auth::id();
        if ($userId) {
            $builder->where($model->getTable().'.user_id', $userId);
        }
    }
}