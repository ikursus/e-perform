<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternetConnection extends Model
{
    use HasFactory;

    protected $table = 'internet_connections';

    protected $fillable = [
        'telco',
        'connection_speed',
        'measurement',
        'user_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the internet connection.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}