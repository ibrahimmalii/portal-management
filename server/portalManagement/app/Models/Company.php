<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relationships.
     *
     * @return HasMany
     */
    public function sub_companies(): HasMany
    {
        return $this->hasMany(SubCompany::class);
    }
}
