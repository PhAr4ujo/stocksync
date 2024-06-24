<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected static function boot()
     {
         parent::boot();
 
         static::creating(function ($model) {
             if (empty($model->{$model->getKeyName()})) {
                 $model->{$model->getKeyName()} = (string) Str::uuid();
             }
         });
    }

    protected $keyType = 'string';
    public $incrementing = false;



    protected $fillable = [
        'name',
        'email',
        'cpf',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function userSetor(): HasMany{
        return $this->hasMany(UserSetor::class);
    }
    
    public function userEmpresa(): HasMany{
        return $this->hasMany(UserEmpresa::class);
    }

}

