<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empresa extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

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
    protected $table = 'empresa';

    protected $fillable = [
        'name'
    ];

    public function setor(): HasMany{
        return $this->hasMany(Setor::class);
    }

    public function tipoSetor(): HasMany{
        return $this->hasMany(TipoSetor::class);
    }

    public function userEmpresa(): HasMany{
        return $this->hasMany(UserEmpresa::class);
    }
}
