<label for="nome" style="padding-right: 5px">Nome do Alarme:</label>

<input type="text" id="nome" name="nome" required style="color: black" 
    value="{{isset($alarme->nome) ? $alarme->nome : null}}">