<?php

namespace App\Http\Controllers;

use App\Models\TipoProduto;
use Illuminate\Http\Request;

class TipoProdutosController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $ope = TipoProduto::create($data);

        if($ope){
            return redirect()->route('workspaces.edit', $data['empresaID']);
        }
        //dd($data);
    }
}
