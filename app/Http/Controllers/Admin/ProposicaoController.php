<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaProposicao;
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
        $categorias = CategoriaProposicao::All();
        return view('admin.proposicoes.edit', ['model' => new Proposicao(),'tipos'=>$tipos, 'categorias'=>$categorias]);
        
    }

    public function edit($id)
    {
        $tipos = (new TipoProposicao())->getAll();
        $categorias = CategoriaProposicao::All();
        $model = Proposicao::find($id);
        return view('admin.proposicoes.edit', ['model' => $model,'tipos'=>$tipos, 'categorias'=>$categorias]);
    }

    public function save(Request $request){
         //validate the request
        //dd($request->all());
        $validationResult = $request->validate([
            'titulo' => 'required|max:255',
            'slug' => 'required',
            // 'descricao' => 'required|max:255',
            // 'protocolo' => 'required|max:255',
            // 'processo' => 'required|max:255',
            // 'data' => 'required|max:255',
            // 'situacao' => 'required|max:255',
            // 'tipo' => 'required|max:255'
        ],[
            'titulo.required' => 'O campo título é obrigatório',
            'slug.required' => 'O campo slug é obrigatório',
            // 'descricao.required' => 'O campo descrição é obrigatório',
            // 'protocolo.required' => 'O campo protocolo é obrigatório',
            // 'processo.required' => 'O campo processo é obrigatório',
            // 'data.required' => 'O campo data é obrigatório',
            // 'situacao.required' => 'O campo situação é obrigatório',
            // 'tipo.required' => 'O campo tipo é obrigatório'
        ]);

        //tests if the validation was successful
        if (!$validationResult) {
            return redirect()->route('admin.proposicoes',)->withErrors($validationResult);
        }
        $model = Proposicao::create($request->all());
        
        return redirect()->route('admin.proposicao');
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
        // 'descricao' => 'required|max:255',
        // 'protocolo' => 'required|max:255',
        // 'processo' => 'required|max:255',
        // 'data' => 'required|max:255',
        // 'situacao' => 'required|max:255',
        // 'tipo' => 'required|max:255'
    ],[
        'titulo.required' => 'O campo título é obrigatório',
        'slug.required' => 'O campo slug é obrigatório',
        // 'descricao.required' => 'O campo descrição é obrigatório',
        // 'protocolo.required' => 'O campo protocolo é obrigatório',
        // 'processo.required' => 'O campo processo é obrigatório',
        // 'data.required' => 'O campo data é obrigatório',
        // 'situacao.required' => 'O campo situação é obrigatório',
        // 'tipo.required' => 'O campo tipo é obrigatório'
    ]);

       //tests if the validation was successful
       if (!$validationResult) {
           return redirect()->route('admin.proposicao',)->withErrors($validationResult);
       }

       $model->update($request->all());
       
       return redirect()->route('admin.proposicao');
   }

    public function delete($id)
    {
        $model = Proposicao::find($id);
        $model->delete();
        return redirect()->route('admin.proposicao');
    }

    //datatable method
    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new Proposicao(), 'titulo', $request);
       // dd($response->data);
        foreach($response->data as $r){
            if($r->categoria != null)
                $r->categoria = CategoriaProposicao::where('slug', $r->categoria)->first()->nome;
            
            if($r->data != null)
                $r->data = date('d/m/Y', strtotime($r->data));
        }
        return response()->json($response, 200);
    }
}
