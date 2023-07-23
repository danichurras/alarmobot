<div wire:poll.keep-alive class="text-2xl text-gray-50 bg-red-600 rounded p-4">
    @forelse($this->mensagens as $mensagem)
        <h2>{{$mensagem}}</h2>
    @empty
        <h2>Nenhuma</h2>
    @endforelse
</div>
