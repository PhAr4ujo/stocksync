<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class SetorProduto extends Model
{
    use HasFactory;


    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'setor_produto';


    protected $fillable = [
        'setor_id',
        'produto_id',
        'quantidade',
    ];


    public function setor(): BelongsTo{
        return $this->belongsTo(Setor::class);
    }

    public function produto(): BelongsTo{
        return $this->belongsTo(Produto::class);
    }
}
