<?php

namespace App\Http\Controllers;

use App\Models\TipoSetor;
use Illuminate\Http\Request;

class TipoSetoresController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $data['nome'] = $data['nomeSetor'];
        $data['empresa_id'] = $data['empresaID'];

        $ope = TipoSetor::create($data);

        if($ope){
            return redirect()->route('workspaces.show', $data['empresaID']);
        }
    }
}
