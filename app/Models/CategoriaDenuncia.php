<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoriaDenuncia extends Model
{
    use HasFactory;

    protected $table = 'categorias_denuncias';

    protected $fillable = [
        'nome',
        'slug'
    ];

    protected $guarded = [
        'id',
    ];

    public function denuncias()
    {
        return Denuncia::where('categoria', $this->slug)->get();
    }
}
