<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ 'Dashboard' }}
                </h2>
                <div class="flex items-center">
                    <span class="mr-4 text-gray-600 dark:text-gray-300">{{ Auth::user()->name }}</span>
                </div>
            </div>
        </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-lg font-semibold mb-4">{{ __("Create Workspace") }}</h2>
                        <button type="submit" id="buttonForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Create</button>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @if(isset($workspaces))
                        @foreach ($workspaces as $item)
                            <div class="flex flex-wrap mb-4">
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex-1 mr-2">
                                    <div class="p-6 text-gray-900 dark:text-gray-100">
                                        <h2 class="text-lg font-semibold mb-4">{{ $item->empresa->name }}</h2>
                                        <p class="text-sm text-gray-600">{{ $item->empresa->id }}</p>
                                        <div class="flex mt-4">
                                            <form action="{{ route('workspaces.destroy', $item->empresa->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded mt-4">
                                                    Excluir
                                                </button>
                                            </form>
                                            <div class="ml-5">
                                                <form action="{{ route('workspaces.show', $item->empresa->id) }}" method="GET">
                                                    @csrf
                                                    @method('GET')
                                                    <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4">
                                                        Acessar
                                                    </button>
                                                </form>    
                                            </div>      
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                
                
    
            </div>
        </div>
    
        <div id="overlay" class="overlay hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="form-popup bg-white shadow-md rounded p-8 w-96">
                <form action="{{ route('workspaces.store') }}" method="POST" class="form-container">
                    @csrf
                    <h2 class="text-xl font-semibold mb-4">New Workspace</h2>
    
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter Name" class="mt-1 p-2 w-full border rounded-md">
                    </div>
    
                    <div class="flex justify-end">
                        <button type="button" id="closeFormButton" class="mr-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancelar</button>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enviar</button>
                    </div>
                </form>
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
</body>
</html>

<script>
    var button = document.getElementById('buttonForm');
    button.addEventListener("click", function(){
        document.getElementsByClassName('overlay')[0].classList.remove("hidden");
        console.log('teste');
    })

    document.getElementById('closeFormButton').addEventListener("click", function(){
        document.getElementsByClassName('overlay')[0].classList.add("hidden")
    })
</script>