<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

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
    protected $table = 'tipo_produto';

    protected $fillable = [
        'nome',
        'setor_id',
    ];

    public function produto(): HasMany{
        return $this->hasMany(Produto::class);
    }

    public function setor(): BelongsTo{
        return $this->belongsTo(Setor::class);
    }
}
