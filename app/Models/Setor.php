<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Setor extends Model
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
    protected $table = 'setor';


    protected $fillable = [
        'nome',
        'tipo_setor_id',
        'empresa_id',
    ];

    public function tipoSetor() : BelongsTo{
        return $this->belongsTo(TipoSetor::class);
    }

    public function empresa() : BelongsTo{
        return $this->belongsTo(Empresa::class);
    }

    public function setorProduto(): HasMany{
        return $this->hasMany(SetorProduto::class);
    }

    public function userSetor(): HasMany{
        return $this->hasMany(UserSetor::class);
    }
}
