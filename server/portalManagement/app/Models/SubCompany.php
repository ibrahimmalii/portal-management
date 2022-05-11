<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCompany extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relationships.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relationships.
     *
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(SubCompanyAttachment::class, 'sub_company_id', 'id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
