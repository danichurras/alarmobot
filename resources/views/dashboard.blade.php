<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Meu Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Bem Vindo {{$usuario->name}}!</p>
                    <br><br>
                    <p>
                        @if($usuario->alarmes->isEmpty())
                            Parece que você ainda não possui nenhum alarme cadastrado. Clique no botão abaixo para criar seu primeiro alarme!
                            <br><br>
                            <a href="{{ route('alarmes.cadastrar') }}" class="hover:text-white"> Cadastrar Alarme</a>
                        @else
                            <a href="{{ route('alarmes.listar') }}" class="hover:text-white"> Listar Alarme(s)</a>
                        @endif
                    </p>    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
