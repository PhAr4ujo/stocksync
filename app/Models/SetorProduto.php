<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SetorProduto extends Model
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
        'setor_id',
        'produto_id',
        'quantidade',
    ];


    public function setor(): BelongsTo{
        return $this->belongsTo(Setor::class);
    }

    public function produtor(): BelongsTo{
        return $this->belongsTo(Produto::class);
    }
}
