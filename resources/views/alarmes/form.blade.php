@props(['alarme' => null])

<x-input-label for="nome" value="Nome do Alarme"/>
<x-text-input id="nome" name="nome" class="block" required :value="$alarme?->nome"/>

<x-input-label for="mac_esp" class="mt-2" value="MAC do ESP"/>
<x-text-input name="mac_esp" class="mb-4" required :value="$alarme?->mac_esp"
    maxlength="17" oninput="updateCharacterCount(this)" onfocusout="verificarTamanho(this)"/>

<div class="counter"></div>

<script>
    function updateCharacterCount(textarea) {
        var maxLength = textarea.getAttribute('maxlength');
        var currentLength = textarea.value.length;

        var counter = textarea.nextElementSibling;
        counter.textContent = currentLength + ' / ' + maxLength;
    }

    function verificarTamanho(elemento) {
        const valor = elemento.value.trim(); // Remover espaços em branco antes e depois do valor

        if (valor.length !== 17) {
            // alert("O campo deve ter exatamente 17 dígitos.");
        }
    }
</script>
