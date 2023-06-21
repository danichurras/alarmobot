<label for="nome" style="padding-right: 5px">Nome do Alarme:</label>

<input type="text" id="nome" name="nome" required style="color: black" 
    value="{{isset($alarme->nome) ? $alarme->nome : null}}">

<br><br>

<label for="mac_esp" style="padding-right: 5px;">MAC do ESP:</label>

<input type="text" id="mac_esp" name="mac_esp" required style="color: black" 
    value="{{isset($alarme->mac_esp) ? $alarme->mac_esp : null}}">