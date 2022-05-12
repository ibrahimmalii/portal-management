<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        'remember_token',
        'email_verified_at',
        'created_at',
        'updated_at',
        'settings',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Company relation
     *
     * @return BelongsTo
     */
    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Sub company relation
     *
     * @return BelongsTo
     */
    public function sub_company():BelongsTo
    {
        return $this->belongsTo(SubCompany::class);
    }

    /**
     * Has many relation with attachments
     *
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(UserAttachment::class);
    }


    /**
     * has many relation with phone
     *
     * @return HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }


    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor');
    }
}
