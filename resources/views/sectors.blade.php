<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $workspace->setor->name }}</title>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="bg-violet-300 hover:bg-violet-400 text-violet-800 font-bold py-2 px-4 rounded inline-block transition duration-300 ease-in-out">
                    Voltar
                </a>
                <div class="flex items-center">
                    <span class="mr-4 text-gray-600 dark:text-gray-300">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-semibold mb-4">Workspace: {{ $workspace->setor->name }}</h2>
                            <p class="text-sm text-gray-600">ID: {{ $workspace->setor->id }}</p>
                        </div>
                        <div class="flex space-x-4">
                            <button id="buttonNewProduct" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-block transition duration-300 ease-in-out">
                                Criar Novo Produto
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($produtos as $produto)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex-1 mr-2">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="text-lg font-semibold mb-4">{{ $produto->produto->nome }}</h2>
                            <p class="text-sm text-gray-600">Quantidade: {{ $produto->quantidade }}</p>
                
                            <div class="mt-4 flex justify-between items-center">
                                <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                                        onclick="exibirFormularioEdicao('{{ $produto->produto_id }}', '{{ $produto->produto->nome }}', {{ $produto->quantidade }})">
                                    Editar
                                </button>
                                
                                <form action="{{ route('products.destroy', $produto->produto_id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                
                            <div id="formulario-edicao-{{ $produto->produto_id }}" class="mt-4 flex justify-end" style="display: none;">
                                <form id="form-edicao-{{ $produto->produto_id }}" action="{{ route('products.update', $produto->produto_id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                
                                    <div class="mb-4">
                                        <label for="nome-{{ $produto->produto_id }}" class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                                        <input type="text" id="nome-{{ $produto->produto_id }}" name="nome" value="{{ $produto->produto->nome }}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                               required>
                                    </div>
                
                                    <div class="mb-4">
                                        <label for="quantidade-{{ $produto->produto_id }}" class="block text-gray-700 text-sm font-bold mb-2">Quantidade:</label>
                                        <input type="number" id="quantidade-{{ $produto->produto_id }}" name="quantidade" value="{{ $produto->quantidade }}"
                                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                               required>
                                    </div>
                
                                    <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                        Salvar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                
            </div>
        </div>
        
        <div id="modal" class="fixed inset-0 z-10 overflow-y-auto hidden bg-gray-800 bg-opacity-50">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-96">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-semibold mb-4">Criar Novo Produto</h2>
                        <form action="{{route('products.store')}}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="nome" class="block text-sm font-medium text-white-700">Nome do Produto:</label>
                                <input required type="text" name="nome" id="nome" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <input type="hidden" value="{{ $workspace->setor->id }}" name="setor_id" id="setor_id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <label for="quantidade" class="block text-sm font-medium text-white-700">Quantidade:</label>
                                <input required type="number" name="quantidade" id="quantidade" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <label for="preco" class="block text-sm font-medium text-white-700">Preço:</label>
                                <input required type="number" name="preco" id="preco" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                            </div>
                            <div class="mb-4">
                                <label for="tipo_produto_id" class="block text-sm font-medium text-white-700">Tipo de setor:</label>
                                <select required name="tipo_produto_id" id="tipo_produto_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 rounded-md bg-gray-800 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Selecione o tipo de produto</option>
                                @foreach ($tipoProduto as $item)
                                    <option value="{{$item->id}}" class="bg-white text-gray-900">{{$item->nome}}</option>
                                @endforeach
                                    
                                    
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-7 rounded inline-block transition duration-300 ease-in-out">Criar</button>
                                <button id="closeModal" class="ml-2 bg-red-500 font-bold py-2 px-4 rounded inline-block hover:bg-red-600 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

        <footer class="bg-gray-200 dark:bg-gray-800 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <form method="GET" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200">Logout</button>
                    </form>
                </div>
            </div>
        </footer>

    </x-app-layout>
    
    <script>
        var btn = document.getElementById('buttonNewProduct').addEventListener("click", function(){
            var form = document.getElementById('modal').classList.remove('hidden');
        })

        var btnClose = document.getElementById('closeModal').addEventListener("click", function(){
            var form = document.getElementById('modal').classList.add('hidden');
        })


        function exibirFormularioEdicao(produtoId, nome, quantidade) {
        // Preenche os campos do formulário com os dados do produto
        document.getElementById('nome-' + produtoId).value = nome;
        document.getElementById('quantidade-' + produtoId).value = quantidade;

        // Atualiza o action do formulário com o produtoId
        document.getElementById('form-edicao-' + produtoId).action = "{{ route('products.update', '') }}/" + produtoId;

        // Exibe o formulário de edição específico do produto
        document.getElementById('formulario-edicao-' + produtoId).style.display = 'block';
    }


    </script>
</body>
</html>
