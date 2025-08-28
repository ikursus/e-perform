<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHolding extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_holdings';

    protected $fillable = [
        'user_id',
        'fund_name',
        'fund_code',
        'transaction_date',
        'transaction_type',
        'total_investment',
        'nav',
        'current_value',
        'unrealized_pl_myr',
        'unrealized_pl_percentage'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'total_investment' => 'decimal:2',
        'nav' => 'decimal:2',
        'current_value' => 'decimal:2',
        'unrealized_pl_myr' => 'decimal:2',
        'unrealized_pl_percentage' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the holding.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transaction type options.
     */
    public static function getTransactionTypes(): array
    {
        return [
            'SA' => 'Subscription/Addition',
            'SW' => 'Switch',
            'RD' => 'Redemption',
            'DV' => 'Dividend'
        ];
    }

    /**
     * Scope to filter by fund code.
     */
    public function scopeByFundCode($query, $fundCode)
    {
        return $query->where('fund_code', $fundCode);
    }

    /**
     * Scope to filter by transaction type.
     */
    public function scopeByTransactionType($query, $transactionType)
    {
        return $query->where('transaction_type', $transactionType);
    }

    /**
     * Scope to filter by date range.
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('transaction_date', [$startDate, $endDate]);
    }
}