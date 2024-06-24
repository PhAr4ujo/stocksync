<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        if ($user) {
            return response()->
            json(['data' => new UserResource($user), ['message' => 'Usuário criado com sucesso'], 201]);
        } else {
            return response()->
            json([['message' => 'Erro ao criar usuário'], 500]);
        }
    }

    public function update(UserRequest $request, $id){
        $user = User::findOrFail($id);
        $data = $request->validated();

        $user->update($data);

        if($user){
            return response()->
            json(['data' => new UserResource($user), ['message' => 'Usuário Atualizado com sucesso']], 200);
        }else{
            return response()->
            json(['message' => 'Erro ao atualizar usuário'], 500);
        }
        
    }

    public function destroy($id){
        $user = User::findOrFail($id);

        $ope = $user->delete();
        
        if($ope){
            return response()->json(['message' => 'Usuário excluído com sucesso'], 204);
        }else {
            return response()->json(['message' => 'Erro ao excluir Usuário'], 500);
        }
    }

    public function create(){
        return view('register');
    }
}
