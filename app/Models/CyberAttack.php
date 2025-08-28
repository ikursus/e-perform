<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CyberAttack extends Model
{
    use HasFactory;

    protected $table = 'cyber_attacks';

    protected $fillable = [
        'attack_frequency',
        'measurement',
        'attack_source',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the cyber attack record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}