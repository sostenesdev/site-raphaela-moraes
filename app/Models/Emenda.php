<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emenda extends Model
{
    use HasFactory, SoftDeletes;



    protected $fillable = [
        'titulo',
        'slug',
        'descricao',
        'objeto',
        'valor',
        'orgao_destino',
        'data_liberacao',
        'beneficiario',
        'estagio_processo',
        'numero_processo',
        'link',
        'ano',
    ];

    protected $guarded = [
        'id',
    ];
}
