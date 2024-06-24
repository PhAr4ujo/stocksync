<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Produto extends Model
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
   protected $table = 'produto';


    protected $fillable = [
        'nome',
        'preco',
        'tipo_produto_id',
    ];

    public function tipoProduto(): BelongsTo{
        return $this->belongsTo(TipoProduto::class);
    }

    public function setorProduto(): HasMany{
        return $this->hasMany(SetorProduto::class);
    }
}
