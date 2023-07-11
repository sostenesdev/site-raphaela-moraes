<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'cargo',
        'funcao',
        'descricao',
        'pessoa_nome',
        'regime_trabalho',
        'user_id'
    ];

    protected $guarded = [
        'id',
    ];

    public function arquivos()
    {
        return $this->belongsToMany(Arquivo::class);
    }

    
}
