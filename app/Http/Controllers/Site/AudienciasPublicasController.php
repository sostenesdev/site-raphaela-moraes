<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AudienciaPublica;

class AudienciasPublicasController extends Controller
{
    public function index()
    {
        $audiencias = AudienciaPublica::orderBy('id', 'desc')->get();
        return view('site_v2.audiencias-publicas', compact('audiencias'));
    }

    public function download_documento($id)
    {
        $model = AudienciaPublica::find($id);
        if (!$model || !$model->documento_base64) {
            abort(404);
        }

        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'txt' => 'text/plain',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
        ];

        $extensao = strtolower($model->documento_extensao);
        $mimeType = $mimeTypes[$extensao] ?? 'application/octet-stream';
        $conteudo = base64_decode($model->documento_base64);

        return response($conteudo, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'attachment; filename="' . $model->documento_nome . '"');
    }
}
