<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'denuncias';

    protected $fillable = [
        'titulo',
        'categoria',
        'conteudo'
    ];

    protected $guarded = [
        'id',
    ];

    public function arquivos()
    {
        return $this->hasMany(ArquivoDenuncia::class);
    }
}
