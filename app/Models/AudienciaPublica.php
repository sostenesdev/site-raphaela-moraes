<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudienciaPublica extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'audiencias_publicas';

    protected $fillable = [
        'titulo',
        'descricao',
        'documento_nome',
        'documento_extensao',
        'documento_base64',
    ];

    protected $guarded = [
        'id',
    ];
}
