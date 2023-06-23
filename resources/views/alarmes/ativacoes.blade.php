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

    .modal {
            display: none; /* Inicialmente oculto */
            position: fixed; /* Posição fixa */
            z-index: 1; /* Sobrepor outros elementos */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Fundo escuro com transparência */
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
                </div>
            </div>
        </div>
    </div>

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
</x-app-layout>

<script>
    function openModal() {
        var modal = document.getElementById("ModalDisparos");
        modal.style.display = "block";
    }

    // Função para fechar o modal
    function closeModal() {
        var modal = document.getElementById("ModalDisparos");
        modal.style.display = "none";
    }
</script>