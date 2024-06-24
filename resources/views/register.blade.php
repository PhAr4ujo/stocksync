<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
    @vite('resources/css/app.css')
    <style>
        .login-container {
            margin: auto;
            max-width: 400px;
        }
    </style>
</head>
<body class="bg-slate-950">

    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md login-container">
            <h2 class="text-2xl font-bold mb-4">Login</h2>
            <form action="{{route ('register')}}" method="post">
                @csrf

                @if ($errors->any())
                <div class="mb-4">
                    <ul class="text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div class="mb-2">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Nome</label>
                    <input type="name" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Digite seu nome" required>
                </div>
                <div class="mb-2">
                    <label for="cpf" class="block text-gray-700 font-bold mb-2">CPF</label>
                    <input type="cpf" name="cpf" id="cpf" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Digite seu CPF" required>
                </div>
                <div class="mb-2">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Digite seu email" required>
                </div>
                <div class="mb-2">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Senha</label>
                    <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Digite sua senha" required>
                </div>
                <div class="mb-2">
                    <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Confirme sua senha" required>
                </div>
                <div class="mb-6">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Entrar</button>
                </div>
                <p class="text-sm text-gray-600 text-center">Já tem uma conta? <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600">Logar-se</a></p>
            </form>
        </div>
    </div>
    
    </body>
</html>
