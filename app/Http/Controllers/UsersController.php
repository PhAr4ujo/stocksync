<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = User::all();

        if($users->isEmpty()){
            return response()->json(['message' => 'Nenhum usuário encontrado'], 204);
        }
        return response()->
        json(['data' => UserResource::collection($users), ['message' => 'Listando todos os usuários com sucesso'], 200]);
        
    }


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
}
