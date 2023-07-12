<style>
    td {
        border: 1px solid ghostwhite; 
        padding-left: 10px;
        padding-right: 10px;
    }

    th {
        border: 1px solid ghostwhite; 
        text-align: center;
        padding: 5px;
        font-size: 20px;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Meu Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <p style="font-size: 30px">Bem Vindo {{$usuario->name}}!</p>
                    <br><br>
                    <p>
                        @if($alarmes->isEmpty())
                            Parece que você ainda não possui nenhum alarme cadastrado. Clique no botão abaixo para criar seu primeiro alarme!
                            <br><br>
                            <a href="{{ route('alarmes.cadastrar') }}"><x-primary-button type="button">Cadastrar Alarme</x-primary-button></a>
                        @else
                            <span style="font-size: 25px; font-weight: bold;">Meus Alarmes</span>
                            <div class="relative sm:flex sm:justify-center mt-2">
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
                                                <td style="text-align: center;">
                                                    {{$alarme->nome}}
                                                </td>
                                                <td style="text-align: center; text-transform: uppercase; font-weight: bold;">
                                                    {{$alarme->status}}
                                                    <br><br>
                                                    <form method="POST" action="{{route('alarmes.atualizarStatus', $alarme->id)}}">
                                                        @csrf
                                                        @method('PUT')
                                                    
                                                            @if($alarme->status == "desativado")
                                                                <x-success-button type="submit">
                                                                    Ativar
                                                                </x-success-button>
                                                            @else
                                                                <x-danger-button type="submit">
                                                                    Desativar  
                                                                </x-danger-button>
                                                            @endif
                                                        
                                
                                                    </form>

                                                </td>
                                                <td style="text-align: center; padding-top:16px">
                                                    <a href="{{ route('alarmes.gerenciar', $alarme->id) }}" class="hover:text-white">
                                                        <x-success-button>Gerenciar</x-success-button>
                                                    </a>
                                                    <br><br>
                                                    <a href="{{ route('alarmes.editar', $alarme->id) }}" class="hover:text-white">
                                                        <x-blue-button>Editar Dados</x-blue-button>
                                                    </a>
                                                    <br><br>
                                                    <form method="POST" action=" {{route('alarmes.deletar', $alarme->id)}} ">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button type="submit">Deletar Alarme</x-danger-button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> 
                            </div>
        
                            <div class="relative sm:flex sm:justify-center mt-16">
                                <a href="{{ route('alarmes.cadastrar') }}"><x-primary-button type="button">Cadastrar Alarme</x-primary-button></a>
                            </div>
                        @endif
                    </p>    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
