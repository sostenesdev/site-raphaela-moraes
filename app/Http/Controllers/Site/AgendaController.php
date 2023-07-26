<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Agenda;


class AgendaController extends Controller
{
    //index
    public function index()
    {
        return view('site_v2.agenda');
    }


    //get events
    public function eventos(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $eventos = Agenda::where('start', '>=', $start)->where('end', '<=', $end)->get();
        foreach($eventos as $e){
            if($e->url == null){
                unset($e->url);
            }
        }
        return response()->json($eventos, 200);
    
    }
    public function evento(Request $request)
    {
        $evento = Agenda::find($request->id);
        return response()->json($evento, 200);
    
    }

}
