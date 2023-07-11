<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatatableService;
use App\Models\Proposicao;
use App\Models\TipoProposicao;


class ProposicaoController extends Controller
{
    public function index()
    {
        return view('admin.proposicoes.index');
    }

    public function new()
    {
        $tipos = (new TipoProposicao())->getAll();
        return view('admin.proposicoes.edit', ['model' => new Proposicao(),'tipos'=>$tipos]);
        
    }

    public function edit($id)
    {
        $tipos = (new TipoProposicao())->getAll();
        $model = Proposicao::find($id);
        return view('admin.proposicoes.edit', ['model' => $model,'tipos'=>$tipos]);
    }

    public function save(Request $request){
         //validate the request
        //dd($request->all());
        $validationResult = $request->validate([
            'titulo' => 'required|max:255',
            'slug' => 'required',
            'descricao' => 'required|max:255',
            'protocolo' => 'required|max:255',
            'processo' => 'required|max:255',
            'data' => 'required|max:255',
            'situacao' => 'required|max:255',
            'tipo' => 'required|max:255'
        ]);
        //add validation messages
        $validationResult['titulo.required'] = 'O campo cargo é obrigatório';
        $validationResult['slug.required'] = 'O campo título deve ser único';
        $validationResult['descricao.required'] = 'O campo Nome deve ser único';
        $validationResult['protocolo.required'] = 'O campo Nome deve ser único';
        $validationResult['processo.required'] = 'O campo Nome deve ser único';
        $validationResult['data.required'] = 'O campo Nome deve ser único';
        $validationResult['situacao.required'] = 'O campo Nome deve ser único';
        $validationResult['tipo.required'] = 'O campo Nome deve ser único';

        //tests if the validation was successful
        if (!$validationResult) {
            return redirect()->route('admin.proposicoes',)->withErrors($validationResult);
        }
        $model = Proposicao::create($request->all());
        
        return view('admin.proposicoes.index');
    }

    public function update(Request $request){
        $id = $request->id;
        $model = Proposicao::find($id);
        if($model == null){
            return view('admin.proposicoes.index');
        }
        //validate the request
       //dd($request->all());
       $validationResult = $request->validate([
        'titulo' => 'required|max:255',
        'slug' => 'required',
        'descricao' => 'required|max:255',
        'protocolo' => 'required|max:255',
        'processo' => 'required|max:255',
        'data' => 'required|max:255',
        'situacao' => 'required|max:255',
        'tipo' => 'required|max:255'
    ]);
    //add validation messages
    $validationResult['titulo.required'] = 'O campo cargo é obrigatório';
    $validationResult['slug.required'] = 'O campo título deve ser único';
    $validationResult['descricao.required'] = 'O campo Nome deve ser único';
    $validationResult['protocolo.required'] = 'O campo Nome deve ser único';
    $validationResult['processo.required'] = 'O campo Nome deve ser único';
    $validationResult['data.required'] = 'O campo Nome deve ser único';
    $validationResult['situacao.required'] = 'O campo Nome deve ser único';
    $validationResult['tipo.required'] = 'O campo Nome deve ser único';


       //tests if the validation was successful
       if (!$validationResult) {
           return redirect()->route('admin.proposicoes',)->withErrors($validationResult);
       }

       $model->update($request->all());
       
       return view('admin.proposicoes.index');
   }

    public function delete($id)
    {
        $model = Proposicao::find($id);
        $model->delete();
        return redirect()->route('admin.proposicoes');
    }

    //datatable method
    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new Proposicao(), 'titulo', $request);
        return response()->json($response, 200);
    }
}
