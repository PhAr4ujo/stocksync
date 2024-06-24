<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Setor;
use App\Models\SetorProduto;
use App\Models\TipoProduto;
use App\Models\TipoSetor;
use App\Models\UserSetor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'tipo_setor_id' => 'required',
            'empresa_id' => 'required',
            'permissao_id' => 'required',
        ]);

        //dd($data);

        $typeSector = [
            'nome' => $data['tipo_setor_id'],
            'empresa_id' => $data['empresa_id'],
        ];

        if(!TipoSetor::where([['nome', $typeSector['nome']], ['empresa_id', $typeSector['empresa_id']]])->first()){
            $typeSectorOpe = TipoSetor::create($typeSector);
            $data['tipo_setor_id'] = $typeSectorOpe['id'];
        }else{
            $typeSectorOpe = TipoSetor::where([['nome', $typeSector['nome']], ['empresa_id', $typeSector['empresa_id']]])->first();
            $data['tipo_setor_id'] = $typeSectorOpe['id'];
        }

        $SectorOpe = Setor::create($data);
        $sectorUser['setor_id'] = $SectorOpe->id;
        $user = Auth::user();
        $sectorUser['user_id'] = $user->id;
        $sectorUser['permissao_id'] = $data['permissao_id'];


        $sectorUser = UserSetor::create($sectorUser);

        return redirect()->route('workspaces.show', ['workspace' => ($data['empresa_id'])])->with('success', 'Setor criado com sucesso!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workspace = UserSetor::where('setor_id', $id)->first();
        $tipoProduto = TipoProduto::where('setor_id', $id)->get();
        $produtos = SetorProduto::where('setor_id', $id)->get();

        return view('sectors', compact('workspace', 'produtos', 'tipoProduto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empresa_id = request('empresa_id');
        $userSector = UserSetor::where('setor_id', $id)->delete();
        $productSector = SetorProduto::where('setor_id', $id)->delete();
        $sector = Setor::destroy($id);

        return redirect()->route('workspaces.show', $empresa_id);
    }
}
