<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\FileService;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content_preview',
        'content',
        'image',
        'thumbnail',
        'autor',
        'user_id',
        'status',
        'highlighted',
        'is_projeto'
    ];

    protected $guarded = [
        'id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //return firts category from this post
    public function category()
    {
        return $this->categories()->first();
    }

    //get files by name using file service
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
