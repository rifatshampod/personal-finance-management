<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Account extends Model
{
    use HasFactory;
    use BelongsToUser;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'type',
        'currency',
        'institution_name',
        'account_number',
        'opening_balance',
        'archived_at',
    ];

    protected $casts = [
        'archived_at' => 'datetime',
        'opening_balance' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model): void {
            if (empty($model->id)) {
                $model->id = (string) Str::ulid();
            }
        });
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    protected function balance(): Attribute
    {
        return Attribute::get(function () {
            $totals = $this->transactions()
                ->selectRaw("SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) as income_total, SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) as expense_total")
                ->first();

            $incomeTotal = (float) ($totals->income_total ?? 0);
            $expenseTotal = (float) ($totals->expense_total ?? 0);
            return (float) $this->opening_balance + $incomeTotal - $expenseTotal;
        });
    }
}


