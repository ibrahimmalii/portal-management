<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiabilityDate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'is_paid' => 'boolean',
    ];

    /**
     * Relation between liability and dates
     *
     * @return BelongsTo
     *
     */
    public function liability() : BelongsTo
    {
        return $this->belongsTo(Liability::class);
    }
}
