<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\SetorProduto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products');
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
        $data = $request->all();

        $ope = Produto::create($data);
        
        if($ope){
            $SetorProduto['produto_id'] = $ope->id; // Utiliza o UUID do produto
            $SetorProduto['setor_id'] = $data['setor_id']; // Utiliza o UUID do setor
            $SetorProduto['quantidade'] = $data['quantidade'];
    
        $opeSecond = SetorProduto::create($SetorProduto);
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $produto = Produto::find($id);

        if ($produto) {
            $produto->update([
                'nome' => $data['nome'],
            ]);
            $produtoqtd = SetorProduto::where('produto_id', $id);
            $produtoqtd->update([
                'quantidade' => $data['quantidade'],
            ]);
        }
        
        return back();
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SetorProduto::where('produto_id', $id)->delete();
        Produto::where('id', $id)->delete();
        

        return back();
    }
}
