<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArquivoDenuncia;
use App\Models\CategoriaDenuncia;
use App\Models\Denuncia;
use Illuminate\Http\Request;
use App\Services\DatatableService;


class DenunciaController extends Controller
{
    public function index()
    {
        return view('admin.denuncias.index');
    }

    public function new()
    {
        $categorias = CategoriaDenuncia::all();
        return view('admin.denuncias.edit', ['model' => new Denuncia(), 'categorias' => $categorias]);
    }

    public function edit($id)
    {
        $categorias = CategoriaDenuncia::all();
        $model = Denuncia::with('arquivos')->find($id);
        return view('admin.denuncias.edit', ['model' => $model, 'categorias' => $categorias]);
    }

    public function save(Request $request)
    {
        $validationResult = $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
            'conteudo.required' => 'O campo conteúdo é obrigatório',
        ]);

        if (!$validationResult) {
            return redirect()->route('admin.denuncia')->withErrors($validationResult);
        }

        $model = Denuncia::create($request->only(['titulo', 'categoria', 'conteudo']));

        // Salvar arquivos em base64
        if ($request->hasFile('arquivos')) {
            foreach ($request->file('arquivos') as $arquivo) {
                $nome = $arquivo->getClientOriginalName();
                $extensao = $arquivo->getClientOriginalExtension();
                $base64 = base64_encode(file_get_contents($arquivo->getRealPath()));

                ArquivoDenuncia::create([
                    'denuncia_id' => $model->id,
                    'descricao' => $nome,
                    'nome' => $nome,
                    'extensao' => $extensao,
                    'base64' => $base64,
                ]);
            }
        }

        return redirect()->route('admin.denuncia');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $model = Denuncia::find($id);
        if ($model == null) {
            return view('admin.denuncias.index');
        }

        $validationResult = $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
            'conteudo.required' => 'O campo conteúdo é obrigatório',
        ]);

        if (!$validationResult) {
            return redirect()->route('admin.denuncia')->withErrors($validationResult);
        }

        $model->update($request->only(['titulo', 'categoria', 'conteudo']));

        // Salvar novos arquivos em base64
        if ($request->hasFile('arquivos')) {
            foreach ($request->file('arquivos') as $arquivo) {
                $nome = $arquivo->getClientOriginalName();
                $extensao = $arquivo->getClientOriginalExtension();
                $base64 = base64_encode(file_get_contents($arquivo->getRealPath()));

                ArquivoDenuncia::create([
                    'denuncia_id' => $model->id,
                    'descricao' => $nome,
                    'nome' => $nome,
                    'extensao' => $extensao,
                    'base64' => $base64,
                ]);
            }
        }

        // Remover arquivos marcados para exclusão
        if ($request->has('remover_arquivos')) {
            ArquivoDenuncia::whereIn('id', $request->remover_arquivos)->delete();
        }

        return redirect()->route('admin.denuncia');
    }

    public function delete($id)
    {
        $model = Denuncia::find($id);
        $model->delete();
        return redirect()->route('admin.denuncia');
    }

    //datatable method
    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new Denuncia(), 'titulo', $request);
        foreach ($response->data as $r) {
            if ($r->categoria != null) {
                $cat = CategoriaDenuncia::where('slug', $r->categoria)->first();
                $r->categoria = $cat ? $cat->nome : $r->categoria;
            }
        }
        return response()->json($response, 200);
    }

    public function download_arquivo($id)
    {
        $arquivo = ArquivoDenuncia::find($id);
        if (!$arquivo) {
            abort(404);
        }

        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'txt' => 'text/plain',
        ];

        $extensao = strtolower($arquivo->extensao);
        $mimeType = $mimeTypes[$extensao] ?? 'application/octet-stream';
        $conteudo = base64_decode($arquivo->base64);

        return response($conteudo, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'attachment; filename="' . $arquivo->nome . '"');
    }
}
