<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\FileService;

class Pagina extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'paginas';

    protected $fillable = [
        'title',
        'menu_title',
        'slug',
        'content_preview',
        'content',
        'image',
        'autor',
        'status'
    ];

    public function getImage()
    {
        $fileService = new FileService();
        $arquivo = $fileService->getByName($this->image);
        if ($arquivo != null && $arquivo->base64 != null) {
            return $arquivo->base64;
        }
        return $arquivo->base64;
    }
}
