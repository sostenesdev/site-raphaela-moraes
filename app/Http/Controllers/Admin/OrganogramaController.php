<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatatableService;
use App\Models\Cargo;


class OrganogramaController extends Controller
{
    public function index()
    {
        return view('admin.organograma.index');
    }

    public function new()
    {
        return view('admin.organograma.edit', ['post' => new Cargo()]);
        
    }

    public function edit($id)
    {
        $post = Cargo::find($id);
        return view('admin.organograma.edit', ['post' => $post]);
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
            return redirect()->route('admin.posts',)->withErrors($validationResult);
        }
        $post = Cargo::create($request->all());
        
        return view('admin.organograma.index');
    }

    public function update(Request $request){
        $id = $request->id;
        $cargo = Cargo::find($id);
        if($cargo == null){
            return view('admin.organograma.index');
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

       $cargo->update($request->all());
       
       return view('admin.organograma.index');
   }

    public function delete($id)
    {
        $cargo = Cargo::find($id);
        $cargo->delete();
        return redirect()->route('admin.organograma');
    }

    //datatable method
    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new Cargo(), 'cargo', $request);
        return response()->json($response, 200);
    }
}
