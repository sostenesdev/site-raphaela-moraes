<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\DatatableService;
use App\Models\CategoriaProposicao;

class CategoriaProposicaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = new CategoriaProposicao();
        return view('admin.categoria-proposicao.index', ['category' => $category]);
    }

    //data_table method
    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new CategoriaProposicao(), 'nome', $request);
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
            // return response()->json($validationResult, 400);
            $category = new CategoriaProposicao();
            $category->nome = $request->nome;
            $category->slug = $request->slug;

            return view('admin.categoria-proposicao.index', ['category'=> $category,'error' => 'Erro ao salvar categoria']);
            
        }
        $category = CategoriaProposicao::create($request->all());
        $category->save();
        // return response()->json($category, 201);
        return redirect()->route('admin.categoria-proposicao');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoriaProposicao::find($id);
        return view('admin.categoria-proposicao.index', compact('category'));
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
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);
        //tests if the validation was successful
        if (!$validationResult) {
            // return response()->json($validationResult, 400);
            $category = new CategoriaProposicao();
            $category->id = $request->id;
            $category->name = $request->name;
            $category->slug = $request->slug;
            //return error to view
            return view('admin.categoria-proposicao.index', ['category'=> $category,'error' => 'Erro ao salvar categoria']);
            
            
        }


        //get id from request
        $id = $request->id;
        $category = CategoriaProposicao::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->save();
        //redirect to index
        return redirect()->route('admin.categories'); 

    }

    public function delete($id)
    {
        $category = CategoriaProposicao::find($id);
        $category->delete();
        return view('admin.categories', compact('category'));
    }
}
