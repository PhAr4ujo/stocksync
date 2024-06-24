<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class TipoSetor extends Model
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
    protected $table = 'tipo_setor';


    protected $fillable = [
        'nome',
        'empresa_id'
    ];


    public function setor(): HasMany{
        return $this->hasMany(Setor::class);
    }

    public function empresa(): BelongsTo{
        return $this->belongsTo(Empresa::class);
    }
}
