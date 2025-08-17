<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Obligation extends Model
{
    use HasFactory;
    use BelongsToUser;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'counterparty_id',
        'direction',
        'principal_amount',
        'currency',
        'purpose',
        'status',
        'due_date',
        'notes',
    ];

    protected $casts = [
        'principal_amount' => 'decimal:2',
        'due_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model): void {
            if (empty($model->id)) {
                $model->id = (string) Str::ulid();
            }
        });
    }

    public function counterparty(): BelongsTo
    {
        return $this->belongsTo(Counterparty::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(ObligationPayment::class);
    }

    protected function remainingAmount(): Attribute
    {
        return Attribute::get(function () {
            $totalPaid = (float) $this->payments()->sum('amount');
            return max(0.0, (float) $this->principal_amount - $totalPaid);
        });
    }
}


