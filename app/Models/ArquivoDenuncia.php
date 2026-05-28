<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArquivoDenuncia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'arquivos_denuncias';

    protected $fillable = [
        'denuncia_id',
        'descricao',
        'nome',
        'extensao',
        'base64',
    ];

    protected $guarded = [
        'id',
    ];

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }
}
