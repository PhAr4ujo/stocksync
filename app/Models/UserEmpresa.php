<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserEmpresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'empresa_id',
    ];

    protected $table = 'users_empresa';

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function empresa(): BelongsTo{
        return $this->belongsTo(Empresa::class);
    }
}
