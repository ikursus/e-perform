<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Digitalization extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'digitalization';

    protected $fillable = [
        'user_id',
        'title',
        'year',
        'development_type',
        'development_period',
        'development_status'
    ];

    protected $casts = [
        'year' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the user that owns the digitalization record.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the development type options.
     */
    public static function getDevelopmentTypes(): array
    {
        return [
            'inhouse' => 'In-house',
            'outsource' => 'Outsource'
        ];
    }

    /**
     * Get the development status options.
     */
    public static function getDevelopmentStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled'
        ];
    }
}