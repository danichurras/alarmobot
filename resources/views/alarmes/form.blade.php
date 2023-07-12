@props(['alarme' => null])

<x-input-label for="nome" value="Nome do Alarme"/>
<x-text-input id="nome" name="nome" class="block mt-2" required :value="$alarme?->nome"/>

<x-input-label for="mac_esp" class="mt-4" value="MAC do ESP"/>
<x-text-input name="mac_esp" class="mt-2 mb-4" required :value="$alarme?->mac_esp"
    maxlength="17" oninput="maskAndCharacterCounter(this)"/>

<div class="counter"></div>

<script>
    function maskAndCharacterCounter(textarea) {
        var maxLength = textarea.getAttribute('maxlength');
        var currentLength = textarea.value.length;

        var counter = textarea.nextElementSibling;
        counter.textContent = currentLength + ' / ' + maxLength;

        //Mascara
        var text = textarea.value;

        // Remover os ":" existentes no texto
        text = text.replace(/:/g, '');

        // Separar o texto a cada dois dígitos
        var textMask = text.match(/.{1,2}/g);

        textarea.value = textMask.join(':');
    }
</script>
