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
                        <p>
                            O status atual do alarme é: 
                            <span style="text-transform: uppercase">{{$alarme->status}}</span>.
                        </p>
                    </div>

                    <div class="relative sm:flex sm:justify-center mt-16">
                        <form method="POST" action="{{route('alarmes.atualizarStatus', $alarme->id)}}">
                            @csrf
                            @method('PUT')
                        
                            <button type="submit" class="hover:text-white">
                                @if($alarme->status == "desativado")
                                    Ativar
                                @else
                                    Desativar  
                                @endif
                            </button>
    
                        </form> 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>