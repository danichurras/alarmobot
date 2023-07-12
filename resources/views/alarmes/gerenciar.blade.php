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

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: black;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
    }

    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gerenciar Alarme') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 mt-8">

                    <div class="relative sm:flex sm:justify-center">
                        <p style="font-size: 25px;">
                            O status atual do alarme é: 
                            <span style="text-transform: uppercase">{{$alarme->status}}</span>.
                        </p>
                    </div>

                    <div class="relative sm:flex sm:justify-center mt-16">
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
                    </div> 
                    
                    <div class="relative sm:flex sm:justify-center mt-14">
                        <p style="font-size: 25px; font-weight: bold;">
                            Ativações
                        </p>
                    </div>

                    <div class="relative sm:flex sm:justify-center mt-2">
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
                                                <button onclick="openModal()" style="color: rgb(107, 145, 223); text-decoration: underline;">
                                                    {{$ativacao->disparou}}
                                                </button>
                                            @else
                                                {{$ativacao->disparou}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>

                    <div class="relative sm:flex sm:justify-center mt-16">
                        <a href="{{ route('dashboard') }}"><x-danger-button type="button">Voltar</x-danger-button></a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if($alarme->ativacaos->count() > 0)
        <div id="ModalDisparos" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                
                <div class="relative sm:flex sm:justify-center">
                    <table style="border-collapse: collapse; color:ghostwhite;" border="1">
                        <thead>
                            <tr>
                                <th width="200px">Disparo_Id</th>
                                <th width="200px">Hora Do Disparo</th>
                                <th width="200px">Silenciado?</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ativacao->disparos as $disparo)
                                <tr>
                                    <td style="text-align: center;">{{$disparo->id}}</td>
                                    <td style="text-align: center;">{{$disparo->hora_disparo}}</td>
                                    <td style="text-align: center;">{{$disparo->silenciou}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    @endif

</x-app-layout>

<script>
    function openModal() {
        var modal = document.getElementById("ModalDisparos");
        modal.style.display = "block";
    }

    function closeModal() {
        var modal = document.getElementById("ModalDisparos");
        modal.style.display = "none";
    }
</script>