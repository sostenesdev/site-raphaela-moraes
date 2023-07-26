<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DatatableService;
use App\Models\Agenda;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Agenda();
        return view('admin.agenda.index',['model' => $model]);
    }

    //data_table method
    public function data_table(Request $request)
    {
        $response = DatatableService::getData(new Agenda(), 'title', $request);
        return response()->json($response, 200);
    }

    //Action that stores a new model received by request
    public function save(Request $request)
    {
        //validates the request
        $validationResult = $request->validate([
            'title' => 'required|max:255'
        ]);
        //tests if the validation was successful
        if (!$validationResult) {
            // return response()->json($validationResult, 400);
            $model = new Agenda();
            $model->title = $request->title;
            $model->description = $request->description;
            $model->color = $request->color;
            $model->start = $request->start;
            $model->end = $request->end;

            return view('admin.agenda.index', ['model'=> $model,'error' => 'Erro ao salvar categoria']);
            
        }
        $model = Agenda::create($request->all());
        $model->slug = $this->slugfy($request->title).'-'.time();
        $model->save();
        // return response()->json($model, 201);
        return redirect()->route('admin.agenda');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Agenda::find($id);
        return view('admin.agenda.index', compact('model'));
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
            'title' => 'required|max:255'
        ]);
        //tests if the validation was successful
        if (!$validationResult) {
            // return response()->json($validationResult, 400);
            $model = new Agenda();
            $model->id = $request->id;
            $model->title = $request->title;
            $model->description = $request->description;
            $model->color = $request->color;
            $model->start = $request->start;
            $model->end = $request->end;
            //return error to view
            return view('admin.agenda.index', ['model'=> $model,'error' => 'Erro ao salvar agenda']);
            
            
        }


        //get id from request
        $id = $request->id;
        $model = Agenda::find($id);
        $model->title = $request->title;
        $model->slug = $this->slugfy($request->title).'-'.time();
        $model->description = $request->description;
        $model->color = $request->color;
        $model->start = $request->start;
        $model->end = $request->end;
        $model->save();
        //redirect to index
        return redirect()->route('admin.agenda'); 

    }

    public function delete($id)
    {
        $model = Agenda::find($id);
        $model->delete();
        return view('admin.categories', compact('model'));
    }

    //gerar slug substituindo carateres do portugues
    public function slugfy($str)
    {
        $str = strtolower($str);
        $str = str_replace(' ', '-', $str);
        $str = str_replace(['á','à','ã','â','ª'], 'a', $str);
        $str = str_replace(['é','è','ê'], 'e', $str);
        $str = str_replace(['í','ì','î'], 'i', $str);
        $str = str_replace(['ó','ò','õ','ô','º'], 'o', $str);
        $str = str_replace(['ú','ù','û'], 'u', $str);
        $str = str_replace(['ç'], 'c', $str);
        $str = str_replace(['ñ'], 'n', $str);
        $str = str_replace(['-','-'], '-', $str);
        return $str;
    }
   
}
