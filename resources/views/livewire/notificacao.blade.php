<div x-data="{ show: @entangle('shouldShow') }" x-show="$wire.shouldShow" x-on:click.outside="show = false"
     class="text-2xl text-gray-50 bg-gray-600 shadow-md rounded pointer-events-auto z-50 fixed top-0 right-0 mr-5 mt-5
           p-2 grid gap-4 grid-cols-6"
     x-transition:enter="transition ease-out duration-150"
     x-transition:enter-start="opacity-0 transform scale-90"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-90">

    <div class="col-span-1 p-2">
        <i class="fas fa-triangle-exclamation text-red-500"></i>
    </div>
    <div class="col-span-5 text-base my-auto">
        @if(isset($mensagem))
            {{ $mensagem['alarme'] . ' disparou em ' . $mensagem['hora']}}
        @endif
    </div>
</div>
