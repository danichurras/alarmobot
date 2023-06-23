@props(['alarme' => null])
<label for="nome" style="padding-right: 5px">Nome do Alarme:</label>

<input type="text" id="nome" name="nome" required style="color: black" 
    value="{{$alarme?->nome}}">

<br><br>

<label for="mac_esp" style="padding-right: 5px;">MAC do ESP:</label>

<input type="text" id="mac_esp" name="mac_esp" required style="color: black" 
    value="{{$alarme?->mac_esp}}" 
    maxlength="17" oninput="updateCharacterCount(this)" onfocusout="verificarTamanho(this);">   

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
            alert("O campo deve ter exatamente 17 dígitos.");
        }
    }
</script>
