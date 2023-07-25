<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaProposicao extends Model
{
    use HasFactory;
    
    protected $table = 'categorias_proposicoes';

    protected $fillable = [
        'nome',
        'slug'
    ];

    protected $guarded = [
        'id',
    ];

    public function proposicoes()
    {
        return Proposicao::where('categoria', $this->slug)->get();
    }
}
