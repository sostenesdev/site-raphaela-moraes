<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\DatatableService;

class CategoriaProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = new Category();
        return view('admin.categories.index', ['category' => $category]);
    }

    public function data_table(Request $request)
    {
        $response = DatatableService::getDataWithBoolFilter(new Category(),'is_projeto', true, 'nome', $request);
        return response()->json($response, 200);
    }

    //Action that stores a new category received by request
    public function save(Request $request)
    {
        //validates the request
        $validationResult = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
        ]);
        //tests if the validation was successful
        if (!$validationResult) {
            // return response()->json($validationResult, 400);
            $category = new Category();
            $category->nome = $request->nome;

            return view('admin.categories.index', ['category'=> $category,'error' => 'Erro ao salvar categoria']);
            
        }
        $category = Category::create($request->all());
        $category->is_projeto = true;
        $category->save();
        // return response()->json($category, 201);
        return redirect()->route('admin.categories');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.index', compact('category'));
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
            'name' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
        ]);
        //tests if the validation was successful
        if (!$validationResult) {
            // return response()->json($validationResult, 400);
            $category = new Category();
            $category->id = $request->id;
            $category->name = $request->name;
            $category->slug = $request->slug;
            //return error to view
            return view('admin.categoria-projeto.index', ['category'=> $category,'error' => 'Erro ao salvar categoria']);
            
            
        }


        //get id from request
        $id = $request->id;
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->is_projeto = true;
        $category->save();
        //redirect to index
        return redirect()->route('admin.categoria-projeto'); 

    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return view('admin.categories', compact('category'));
    }
}
