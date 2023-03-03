<?php

namespace App\Models;

use App\Enums\TransactionProcessEnum;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property string $hash
 * @property int $reference_id
 * @property float $amount
 * @property float $current_balance
 * @property int $process
 */
class Transaction extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id' => 'int',
        'reference_id' => 'int',
        'amount' => 'float',
        'current_balance' => 'float',
        'process' => TransactionProcessEnum::class,
        'created_at' => 'datetime:Y-d-m H:i:s',
        'updated_at' => 'datetime:Y-d-m H:i:s',
    ];

    protected $hidden = [
        'id',
        'hash',
    ];

    protected $fillable = [
        'user_id',
        'hash',
        'reference_id',
        'amount',
        'current_balance',
        'process',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
