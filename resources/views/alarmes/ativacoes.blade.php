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
            {{ __('Minhas Ativacoes') }}
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
                                    <th width="200px">Data de Ativação</th>
                                    <th width="200px">Data de Desativação</th>
                                    <th width="200px">Disparou?</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($alarme->ativacaos->sortByDesc('data_ativacao') as $ativacao)
                                    <tr>
                                        <td style="text-align: center;">{{$ativacao->data_ativacao}}</td>
                                        <td style="text-align: center;">{{$ativacao->data_desativacao}}</td>
                                        <td style="text-align: center;">
                                            @if($ativacao->disparo)
                                                <a href="" 
                                                style="color: rgb(107, 145, 223); text-decoration: underline;">
                                                    {{$ativacao->disparou}}
                                                </a>
                                            @else
                                                {{$ativacao->disparou}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>