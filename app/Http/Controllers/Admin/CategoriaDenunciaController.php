<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatatableService;
use App\Models\CategoriaDenuncia;

class CategoriaDenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = new CategoriaDenuncia();
        return view('admin.categoria-denuncia.index', ['category' => $category]);
    }

    //data_table method
    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new CategoriaDenuncia(), 'nome', $request);
        return response()->json($response, 200);
    }

    //Action that stores a new category received by request
    public function save(Request $request)
    {
        //validates the request
        $validationResult = $request->validate([
            'nome' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);
        //tests if the validation was successful
        if (!$validationResult) {
            $category = new CategoriaDenuncia();
            $category->nome = $request->nome;
            $category->slug = $request->slug;

            return view('admin.categoria-denuncia.index', ['category' => $category, 'error' => 'Erro ao salvar categoria']);
        }
        $category = CategoriaDenuncia::create($request->all());
        $category->save();
        return redirect()->route('admin.categoria-denuncia');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoriaDenuncia::find($id);
        return view('admin.categoria-denuncia.index', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validationResult = $request->validate([
            'id' => 'required',
            'nome' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);
        //tests if the validation was successful
        if (!$validationResult) {
            $category = new CategoriaDenuncia();
            $category->id = $request->id;
            $category->nome = $request->nome;
            $category->slug = $request->slug;
            return view('admin.categoria-denuncia.index', ['category' => $category, 'error' => 'Erro ao salvar categoria']);
        }

        $id = $request->id;
        $category = CategoriaDenuncia::find($id);
        $category->nome = $request->nome;
        $category->slug = $request->slug;
        $category->save();
        return redirect()->route('admin.categoria-denuncia');
    }

    public function delete($id)
    {
        $category = CategoriaDenuncia::find($id);
        $category->delete();
        return redirect()->route('admin.categoria-denuncia');
    }
}
