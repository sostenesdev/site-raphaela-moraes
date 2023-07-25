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

   //get categoria
   public function getCategoria(){
     return CategoriaProposicao::where('slug', $this->categoria)->first();
   }
}
