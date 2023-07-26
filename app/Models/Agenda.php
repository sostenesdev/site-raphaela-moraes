<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agenda extends Model
{
    use HasFactory;
    
    protected $table = 'agendas';

    protected $fillable = [
        'title',
        'slug',
        'color',
        'description',
        'url',
        'start',
        'end',
    ];

    protected $guarded = [
        'id',
    ];

    // protected $casts = [
    //     'start' => 'datetime:d/m/Y H:i',
    //     'end' => 'datetime:d/m/Y H:i',
    //   ];

}
