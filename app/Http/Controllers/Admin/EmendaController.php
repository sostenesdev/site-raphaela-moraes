<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emenda;
use Illuminate\Http\Request;
use App\Services\DatatableService;



class EmendaController extends Controller
{
    public function index()
    {
        return view('admin.emendas.index');
    }

    public function new()
    {
        $categorias = Emenda::All();
        return view('admin.emendas.edit', ['model' => new Emenda()]);
        
    }

    public function edit($id)
    {
        $model = Emenda::find($id);
        return view('admin.emendas.edit', ['model' => $model]);
    }

    public function save(Request $request){
        $model = Emenda::create($request->all());
        return redirect()->route('admin.emenda');
    }

    public function update(Request $request){
        $id = $request->id;
        $model = Emenda::find($id);
        if($model == null){
            return redirect()->route('admin.emendas');
        }
      
       $model->update($request->all());
       
       return redirect()->route('admin.emenda');
   }

    public function delete($id)
    {
        $model = Emenda::find($id);
        $model->delete();
        return redirect()->route('admin.emenda');
    }

    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new Emenda(), 'titulo', $request);
        return response()->json($response, 200);
    }
}
