<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $workspace->empresa->name }}</title>
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
                            <h2 class="text-lg font-semibold mb-4">Workspace: {{ $workspace->empresa->name }}</h2>
                            <p class="text-sm text-gray-600">ID: {{ $workspace->empresa->id }}</p>
                        </div>
                        <div class="flex space-x-4">
                            
                            <button id="buttonNewSector" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded inline-block transition duration-300 ease-in-out">
                                Criar Novo Setor
                            </a>
                            <form action=" {{ route('workspaces.edit', $workspace->empresa->id) }} ">
                                @csrf
                                <button  id="buttonSettings" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-3 rounded inline-flex items-center transition duration-300 ease-in-out">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                    </svg>      
                                    Configurar Workspace
                                </button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="modal" class="fixed inset-0 z-10 overflow-y-auto hidden bg-gray-800 bg-opacity-50">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-96">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        
                        <h2 class="text-lg font-semibold mb-4">Criar Novo Setor</h2>
                        <form action="{{ route('sectors.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-4">
                                <label for="nome" class="block text-sm font-medium text-white-700">Nome do Setor:</label>
                                <input required type="text" name="nome" id="nome" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full bg-gray-800 shadow-sm sm:text-sm border-gray-300 rounded-md bg-black-100 focus:outline-none">
                            </div>
                            <input type="hidden" name="empresa_id" value="{{ $workspace->empresa->id }}">
                            <div class="mb-4">
                                <label for="tipo_setor_id" class="block text-sm font-medium text-white-700">Tipo de setor:</label>
                                <select required name="tipo_setor_id" id="tipo_setor_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 rounded-md bg-gray-800 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Selecione o tipo de setor</option>
                                @foreach ($tipoSector as $item)
                                    <option value="{{$item->id}}" class="bg-white text-gray-900">{{$item->nome}}</option>
                                @endforeach
                                    
                                    
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="permissao_id" class="block text-sm font-medium text-white-700">Permissão:</label>
                                <select required name="permissao_id" id="tipo_setor_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 rounded-md bg-gray-800 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Selecione a permissão</option>
                                    @foreach ($permissions as $item)
                                        <option value=" {{ $item->id }} " id="tipo_setor_id" class="bg-white text-gray-900"> {{ $item->nome }} </option>
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

        @foreach ($sectors as $item)
            
        
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex-1 mr-2">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="text-lg font-semibold mb-4">{{ $item->nome }}</h2>
                            <p class="text-sm text-gray-600"> {{ $item->tipoSetor->nome  }} </p>
                            <div class="flex items-center mt-5">
                                <form action="{{ route('sectors.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mr-5">
                                        Excluir
                                    </button>
                                    <input type="hidden" name="empresa_id" value="{{$workspace->empresa->id}}">
                                </form>
                                                             
                                <form action="{{ route('sectors.show', $item->id) }}" method="GET">
                                    @csrf
                                    <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                                        Acessar
                                    </button>
                                </form>
                            </div>                       
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
        
        
        
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
</body>
</html>
<script>
    var btn = document.getElementById('buttonNewSector').addEventListener("click", function(){
        var form = document.getElementsByClassName('fixed inset-0 z-10 overflow-y-auto')[0].classList.remove('hidden');
    })

    var btnClose = document.getElementById('closeModal').addEventListener("click", function(){
        var form = document.getElementsByClassName('fixed inset-0 z-10 overflow-y-auto')[0].classList.add('hidden');
    })
    
</script>
