<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSetor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'setor_id',
        'permissao_id',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function setor(): BelongsTo{
        return $this->belongsTo(Setor::class);
    }

    public function permissao(): BelongsTo{
        return $this->belongsTo(Permissao::class);
    }
}
