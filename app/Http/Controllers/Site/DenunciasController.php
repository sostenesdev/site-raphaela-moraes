<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Denuncia;
use App\Models\CategoriaDenuncia;
use App\Models\ArquivoDenuncia;

class DenunciasController extends Controller
{
    public function index()
    {
        $categorias = CategoriaDenuncia::all();
        return view('site_v2.denuncias', compact('categorias'));
    }

    public function save(Request $request)
    {
        $validationResult = $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
            'categoria' => 'required',
            'captcha' => 'required|captcha',
        ], [
            'titulo.required' => 'O campo título é obrigatório',
            'conteudo.required' => 'O campo conteúdo é obrigatório',
            'categoria.required' => 'O campo categoria é obrigatório',
            'captcha.required' => 'O código de verificação é obrigatório',
            'captcha.captcha' => 'Código de verificação incorreto',
        ]);

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

        return redirect()->route('site.denuncias')->with('success', 'Denúncia enviada com sucesso!');
    }
}
