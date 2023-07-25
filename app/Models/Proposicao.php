<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposicao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proposicoes';
    
    protected $fillable = [
        'user_id',
        'id_integracao',
        'titulo',
        'slug',
        'descricao',
        'protocolo',
        'processo',
        'data',
        'situacao',
        'tipo',
        'categoria',
        'conteudo'
    ];

    protected $guarded = [
        'id',
    ];

    // public function posts()
    // {
    //     return $this->belongsToMany(Post::class);
    // }
}
