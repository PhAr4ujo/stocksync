<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoProduto extends Model
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


    protected $fillable = [
        'nome',
    ];

    public function produto(): HasMany{
        return $this->hasMany(Produto::class);
    }
}
