<?php

namespace App\Models;

use App\Enums\WalletStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property float $balance
 * @property int $status
 */
class Wallet extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id' => 'int',
        'balance' => 'float',
        'status' => WalletStatusEnum::class,
        'created_at' => 'datetime:Y-d-m H:i:s',
        'updated_at' => 'datetime:Y-d-m H:i:s',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
