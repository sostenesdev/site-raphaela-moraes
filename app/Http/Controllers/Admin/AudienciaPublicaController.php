<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AudienciaPublica;
use Illuminate\Http\Request;
use App\Services\DatatableService;

class AudienciaPublicaController extends Controller
{
    public function index()
    {
        return view('admin.audiencias-publicas.index');
    }

    public function new()
    {
        return view('admin.audiencias-publicas.edit', ['model' => new AudienciaPublica()]);
    }

    public function edit($id)
    {
        $model = AudienciaPublica::find($id);
        return view('admin.audiencias-publicas.edit', ['model' => $model]);
    }

    public function save(Request $request)
    {
        $validationResult = $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
        ]);

        if (!$validationResult) {
            return redirect()->route('admin.audiencia-publica')->withErrors($validationResult);
        }

        $model = AudienciaPublica::create($request->only(['titulo', 'descricao']));

        // Salvar documento em base64
        if ($request->hasFile('documento')) {
            $arquivo = $request->file('documento');
            $model->documento_nome = $arquivo->getClientOriginalName();
            $model->documento_extensao = $arquivo->getClientOriginalExtension();
            $model->documento_base64 = base64_encode(file_get_contents($arquivo->getRealPath()));
            $model->save();
        }

        return redirect()->route('admin.audiencia-publica');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $model = AudienciaPublica::find($id);
        if ($model == null) {
            return view('admin.audiencias-publicas.index');
        }

        $validationResult = $request->validate([
            'titulo' => 'required|max:255',
            'descricao' => 'required',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
        ]);

        if (!$validationResult) {
            return redirect()->route('admin.audiencia-publica')->withErrors($validationResult);
        }

        $model->update($request->only(['titulo', 'descricao']));

        // Salvar novo documento em base64 (substitui o anterior)
        if ($request->hasFile('documento')) {
            $arquivo = $request->file('documento');
            $model->documento_nome = $arquivo->getClientOriginalName();
            $model->documento_extensao = $arquivo->getClientOriginalExtension();
            $model->documento_base64 = base64_encode(file_get_contents($arquivo->getRealPath()));
            $model->save();
        }

        // Remover documento se marcado
        if ($request->has('remover_documento') && $request->remover_documento == '1') {
            $model->documento_nome = null;
            $model->documento_extensao = null;
            $model->documento_base64 = null;
            $model->save();
        }

        return redirect()->route('admin.audiencia-publica');
    }

    public function delete($id)
    {
        $model = AudienciaPublica::find($id);
        $model->delete();
        return redirect()->route('admin.audiencia-publica');
    }

    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new AudienciaPublica(), 'titulo', $request);
        return response()->json($response, 200);
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
