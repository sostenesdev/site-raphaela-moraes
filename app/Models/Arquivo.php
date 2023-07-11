<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arquivo extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'descricao',
        'nome',
        'extensao',
        'base64'
    ];

    protected $guarded = [
        'id',
    ];

    public function cargos()
    {
        return $this->belongsToMany(Cargo::class);
    }
}
