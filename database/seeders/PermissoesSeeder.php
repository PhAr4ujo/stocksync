<?php

namespace Database\Seeders;

use App\Models\Permissao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PermissaoFactory;


class PermissoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Permissao::create([
            'nome' => 'Administrador',
            'descricao' => 'Esta permissão concede acesso completo para realizar todas as operações dentro do setor.'
        ]);

        \App\Models\Permissao::create([
            'nome' => 'Visualizador',
            'descricao' => 'Esta permissão permite apenas visualização, sem a capacidade de fazer alterações dentro do setor.'
        ]);
    }
}
