<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkspaceFormRequest;
use App\Models\Empresa;
use App\Models\Permissao;
use App\Models\Setor;
use App\Models\TipoSetor;
use App\Models\UserEmpresa;
use App\Models\UserSetor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    public function index(){

    }


    public function edit($id){
        $workspace = UserEmpresa::where('empresa_id', $id)->first();
        $user = Auth::user();
        $setors = Setor::where('empresa_id', $id)->get();
        //dd($setors);
        //dd($workspace);
        return view('workspaceEdit', compact('workspace', 'user', 'setors'));
    }


    public function store(WorkspaceFormRequest $request){
        $data = $request->validated();
        
        $user = Auth::user('id');

        $workspaceData = Empresa::create($data);
        $workspace = [
            'user_id' => $user->id,
            'empresa_id' => $workspaceData->id,
        ];

        $ope = UserEmpresa::create($workspace);

        if($ope){
           return redirect()->route('dashboard');
        }else{
            return back()->withErrors();
        }

    }

    public function destroy($id){
        $userWorkspace = UserEmpresa::where('empresa_id', $id)->delete();
        $workspace = Empresa::destroy($id);
        $typeSector = TipoSetor::where('empresa_id', $id)->delete();

        return redirect()->route('dashboard');
    }

    public function show($id){
        $workspace = UserEmpresa::where('empresa_id', $id)->first();
        $user = Auth::user();
        $sectors = Setor::where('empresa_id', $id)->get();
        $tipoSector = TipoSetor::where('empresa_id', $id)->get();


        $permissions = Permissao::all();

        return view('workspace', compact('workspace', 'sectors', 'permissions', 'tipoSector'));
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $empresa = Empresa::find($id);
        $ope = $empresa->update($data);

        if($ope){
            return redirect()->route('workspaces.edit', $data['empresaID']);
        }
    }
}
