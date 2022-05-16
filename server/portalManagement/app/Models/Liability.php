<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Liability extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
        'is_fully_paid' => 'boolean',
    ];

    /**
     * Relation with liability dates
     *
     * @return HasMany
     */
    public function dates(): HasMany
    {
        return $this->hasMany(LiabilityDate::class);
    }

    /**
     * Relation with user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation between main company
     *
     * @return BelongsTo
     */
    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relation between the sub company
     *
     * @return BelongsTo
     */
    public function subCompany():BelongsTo
    {
        return $this->belongsTo(SubCompany::class);
    }


    /**
     * Relation with product
     *
     * @return BelongsTo
     */
    public function product (): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
