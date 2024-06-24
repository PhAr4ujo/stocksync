<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Permissao extends Model
{
    use HasFactory;

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
    protected $table = 'permissao';


    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function userSetor(): HasMany{
        return $this->hasMany(UserSetor::class);
    }
}
