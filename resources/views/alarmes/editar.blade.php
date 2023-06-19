<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Alarme') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 mt-8">
                    <form method="POST" action="{{route('alarmes.atualizar', $alarme->id)}}">
                        @csrf
                        @method('PUT')

                        <label for="nome" style="padding-right: 5px">Nome do Alarme:</label>
                        <input type="text" id="nome" name="nome" required style="color: black" value="{{$alarme->nome}}">

                        <div class="flex justify-center sm:items-center sm:justify-between ml-10 mr-10 mt-10">
                            <a href="{{ route('alarmes.listar') }}" class="hover:text-white">Cancelar</a>
                            <button class="hover:text-white" type="submit">
                                Atualizar
                            </button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>