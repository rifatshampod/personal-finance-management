<?php

namespace App\Models\Concerns;

use App\Models\Scopes\OwnedByUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    // Automatically called by Eloquent when the trait is used
    protected static function bootBelongsToUser(): void
    {
        static::addGlobalScope(new OwnedByUserScope());

        static::creating(function (Model $model): void {
            if (empty($model->user_id) && Auth::id()) {
                $model->user_id = Auth::id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}


