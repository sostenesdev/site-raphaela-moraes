<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
/*
    Exemplo de utilização: 
     public function data_table(Request $request){
        $response = DatatableService::getData(new User(), 'name', $request);
        return response()->json($response, 200);
    }
 */
class DatatableService{
    public static function getData(Model $model, string $searchParam, Request $request){
        $start = $request['start'];
        $search = $request['search'];
        $draw = $request['draw'];
        $pageSize = 10;
        $search = $request['search']['value'];
        if($search != null){
            $result = $model::where($searchParam,'LIKE', '%'.$search.'%' )->skip($start)->take($pageSize)->get();
        }else{
            $result = $model::skip($start)->take($pageSize)->get();
        }
        $recordsTotal = $model::count();
        $response = (object)['data'=>$result, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsTotal, $draw];
        return $response;
    }

    public static function getDataWithBoolFilter(Model $model, string $blFilter, $blValue="post", string $searchParam, Request $request){
        $start = $request['start'];
        $search = $request['search'];
        $draw = $request['draw'];
        $pageSize = 10;
        $search = $request['search']['value'];
        $query = $model::where($blFilter,$blValue);
        if($search != null){
            $result = $query->where($searchParam,'LIKE', '%'.$search.'%' );
        }
        
        $result = $query->skip($start)->take($pageSize)->get();
        $recordsTotal = $model::count();
        $response = (object)['data'=>$result, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsTotal, $draw];
        return $response;
    }
}