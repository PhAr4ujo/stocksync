<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>teste</title>
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
                            <h2 class="text-lg font-semibold mb-4">Workspace: {{$workspace->empresa->name}}</h2>
                            <p class="text-sm text-gray-600">ID: {{$workspace->empresa->id}}</p>
                        </div>
                        <div class="flex space-x-4">
                            <button id="buttonNewSector" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-block transition duration-300 ease-in-out">
                                Criar Novo Tipo de Setor
                            </button>
                            <button id="buttonNewProduct" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded inline-block transition duration-300 ease-in-out">
                                Criar Novo Tipo de Produto
                            </button>
                            <button id="buttonSettings" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-3 rounded inline-flex items-center transition duration-300 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                </svg>      
                                Configurar Workspace
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <!-- Modais -->
    <div id="modalNewSector" class="fixed inset-0 z-10 overflow-y-auto hidden bg-gray-800 bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-96">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Criar Novo Tipo de Setor</h2>
                    <form method="POST" action="{{ route('typeSector.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="nomeSetor" class="block text-sm font-medium text-gray-700">Nome do Setor:</label>
                            <input type="text" name="nomeSetor" id="nomeSetor" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <input type="hidden" name="empresaID" id="empresaID" value="{{$workspace->empresa->id}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-7 rounded inline-block transition duration-300 ease-in-out">Criar</button>
                            <button type="button" id="closeModalNovoTipoSetor" class="ml-2 bg-red-500 font-bold py-2 px-4 rounded inline-block hover:bg-red-600 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200">Cancelar</button>
                        </div>
                    </form>          
                </div>
            </div>
        </div>
    </div>

    <div id="modalNewProduct" class="fixed inset-0 z-10 overflow-y-auto hidden bg-gray-800 bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-96">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Criar Novo Tipo de Produto</h2>
                    <form action="{{ route('productsTypes.store', $workspace->empresa->id) }}" method="POST">
                        @method('POST')
                        @csrf
                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Tipo de Produto:</label>
                            <input type="text" name="nome" id="nome" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <label for="nomeTipoProduto" class="block text-sm font-medium text-gray-700">Setor:</label>
                            <div class="relative">
                                <select name="setor_id" id="nomeTipoProduto" class="block appearance-none w-full bg-gray-800 border border-gray-300 text-white py-2 px-3 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Selecione o setor</option>
                                    @foreach ($setors as $item)
                                        <option value="{{$item->id}}">{{$item->nome}}</option>
                                    @endforeach
                                    
                                </select>
                                <div class="mb-4">
                                    <input type="hidden" name="empresaID" id="empresaID" value="{{$workspace->empresa->id}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                                </div>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                                    <!-- Heroicon name: solid/chevron-down -->
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-7 rounded inline-block transition duration-300 ease-in-out">Criar</button>
                            <button type="button" id="closeModalTipoProduto" class="ml-2 bg-red-500 font-bold py-2 px-4 rounded inline-block hover:bg-red-600 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modalSettings" class="fixed inset-0 z-10 overflow-y-auto hidden bg-gray-800 bg-opacity-50">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-96">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-lg font-semibold mb-4">Configurar Workspace</h2>
                    <form action="{{ route('workspaces.update', $workspace->empresa->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome da Workspace:</label>
                            <input type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                        </div>
                        <div class="mb-4">
                            <input type="hidden" name="empresaID" id="empresaID" value="{{$workspace->empresa->id}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-7 rounded inline-block transition duration-300 ease-in-out">Atualizar</button>
                            <button type="button" id="closeModalConfigure" class="ml-2 bg-red-500 font-bold py-2 px-4 rounded inline-block hover:bg-red-600 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-200">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </x-app-layout>
</body>
</html>

<script>
    var btnNewSector = document.getElementById('buttonNewSector');
    var btnNewProduct = document.getElementById('buttonNewProduct');
    var btnSettings = document.getElementById('buttonSettings');
    
    var modalNewSector = document.getElementById('modalNewSector');
    var modalNewProduct = document.getElementById('modalNewProduct');
    var modalSettings = document.getElementById('modalSettings');
    
    btnNewSector.addEventListener("click", function(){
        modalNewSector.classList.remove('hidden');
    });
    
    btnNewProduct.addEventListener("click", function(){
        modalNewProduct.classList.remove('hidden');
    });
    
    btnSettings.addEventListener("click", function(){
        modalSettings.classList.remove('hidden');
    });

    var btnClose = document.getElementById('closeModalNovoTipoSetor').addEventListener("click", function(){
    var modal = document.getElementById('modalNewSector');
    modal.classList.add('hidden');
    });

    var btnClose = document.getElementById('closeModalTipoProduto').addEventListener("click", function(){
    var modal = document.getElementById('modalNewProduct');
    modal.classList.add('hidden');
    });

    var btnClose = document.getElementById('closeModalConfigure').addEventListener("click", function(){
    var modal = document.getElementById('modalSettings');
    modal.classList.add('hidden');
    });
    
</script>
