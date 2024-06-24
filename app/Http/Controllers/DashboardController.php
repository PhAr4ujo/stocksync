<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\UserEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $workspaces = UserEmpresa::where('user_id', $user->id)->get();

        return view('dashboard', compact('workspaces'));
    }
}
