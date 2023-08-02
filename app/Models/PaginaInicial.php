<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\FileService;

class PaginaInicial extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pagina_inicial';
    
    protected $fillable = [
        'titulo',
        'subtitulo',
        'sobre_previa',
        'texto_projetos',
        'texto_organograma',
        'imagem_principal',
        'endereco',
        'email',
        'telefone',
        'twitter',
        'facebook',
        'instagram',
        'linkedin',
        'whatsapp',
        'ativar_organograma'
    ];

    protected $guarded = [
        'id',
    ];

    public function getImage()
    {
        $fileService = new FileService();
        $arquivo = $fileService->getByName($this->imagem_principal);
        if ($arquivo != null && $arquivo->base64 != null) {
            return $arquivo->base64;
        }
        return $arquivo->base64;
    }
}
