<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DatatableService;
use App\Models\User;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $permissions = (new PermissionService)->getPermissions();
        return view('admin.user.index', ['user' =>new User(),'permissions' =>$permissions]);
    }

    //edit user page
    public function edit($id){
        $user = User::find($id);
        $permissions = (new PermissionService)->getPermissions();
        return view('admin.user.index', ['user' => $user, 'permissions' => $permissions]);
    }
    
    public function data_table(Request $request){
        $response = DatatableService::getData(new User(), 'name', $request);
        return response()->json($response, 200);
    }
    //create user
    public function save(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->group = $request->group;
        $user->save();
        //$user->syncPermissions($request->permissions);
        // return response()->json(['message' => 'User created successfully'], 200);
        return redirect()->route('admin.user')->with(['message' => 'Usuário criado com sucesso']);
    }

    //save user
    public function update(Request $request){
        $user = User::find($request->id);
        if(!$user){
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->group = $request->group;
        $user->save();
        //$user->syncPermissions($request->permissions);
        return redirect()->route('admin.user')->with('message', 'Usuário atualizado com sucesso');
    }

    //delete user
    public function delete($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect()->route('admin.user')->with(['message' => 'Usuário criado com sucesso']);
        }
        return redirect()->route('admin.user')->with(['error_message' => 'Erro ao remover usuário']);
    }

}

