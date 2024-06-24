<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function __construct(
        protected AuthController $loginController
    )
    {
        
    }

    public function index(){
        return view('register');
    }

    public function register(RegisterFormRequest $request){
        
        $userData = $request->validated();
        $ope = User::create($userData);

        $credencials = [
            'email' => $userData['email'],
            'password' => $userData['password'],
        ];

        if(Auth::attempt($credencials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors();
    }
}
