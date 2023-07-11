<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatatableService;
use App\Models\Proposicao;


class ProposicaoController extends Controller
{
    public function index()
    {
        return view('admin.proposicoes.index');
    }

    public function new()
    {
        return view('admin.proposicoes.edit', ['post' => new Proposicao()]);
        
    }

    public function edit($id)
    {
        $model = Proposicao::find($id);
        return view('admin.proposicoes.edit', ['model' => $model]);
    }

    public function save(Request $request){
         //validate the request
        //dd($request->all());
        $validationResult = $request->validate([
            'cargo' => 'required|max:255',
            'funcao' => 'required|max:255',
            'pessoa_nome' => 'required|max:255'
        ]);
        //add validation messages
        $validationResult['slug.required'] = 'O campo cargo é obrigatório';
        $validationResult['funcao.required'] = 'O campo título deve ser único';
        $validationResult['pessoa_nome.required'] = 'O campo Nome deve ser único';

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
           'cargo' => 'required|max:255',
           'funcao' => 'required|max:255',
           'pessoa_nome' => 'required|max:255'
       ]);
       //add validation messages
       $validationResult['slug.required'] = 'O campo cargo é obrigatório';
       $validationResult['funcao.required'] = 'O campo título deve ser único';
       $validationResult['pessoa_nome.required'] = 'O campo Nome deve ser único';

       //tests if the validation was successful
       if (!$validationResult) {
           return redirect()->route('admin.posts',)->withErrors($validationResult);
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
