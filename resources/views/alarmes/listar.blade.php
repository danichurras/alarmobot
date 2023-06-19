<style>
    td {
        border: 1px solid ghostwhite; 
        padding-left: 10px;
        padding-right: 10px;
    }

    th {
        border: 1px solid ghostwhite; 
        text-align: center;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Meus Alarmes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 mt-4 sm:items-center">
                    <div class="relative sm:flex sm:justify-center">
                        <table style="border-collapse: collapse; color:ghostwhite;" border="1">
                            <thead>
                                <tr>
                                    <th width="200px">Alarme</th>
                                    <th width="200px">Status</th>
                                    <th width="200px">Opções</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($alarmes as $alarme)
                                    <tr>
                                        <td style="text-align: justify;">{{$alarme->nome}}</td>
                                        <td style="text-align: center; text-transform: uppercase">{{$alarme->status}}</td>
                                        <td style="text-align: center; padding-top:16px">
                                            <a href="{{ route('alarmes.gerenciar', $alarme->id) }}" class="hover:text-white">Gerenciar</a>
                                            <br>
                                            <a href="{{ route('alarmes.editar', $alarme->id) }}" class="hover:text-white">Editar</a>
                                            <br>
                                            <form method="POST" action=" {{route('alarmes.deletar', $alarme->id)}} ">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:text-white">Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>

                    <div class="relative sm:flex sm:justify-center mt-16">
                        <a href="{{ route('alarmes.cadastrar') }}" class="hover:text-white">Cadastrar Novo Alarme</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>