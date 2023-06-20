## Sobre o Alarmobot
Essa aplicação Laravel serve como interface de usuário para controle de usuários e gerenciamento de alarmes. A aplicação se comunica via MQTT com um broker e o broker troca informações com o ESP8266, podendo enviar comandos para arme, desarme e silenciamento do alarme. O ESP8266 se comunica com o mesmo broker para enviar um alerta de que o alarme foi disparado.

## Instalação

```bash
# clone o repositório
git clone https://github.com/DanielChavesSimao/alarmobot.git
# vá para a pasta raíz da aplicação
cd alarmobot
```
```bash
# instale as dependências do composer
composer install
# configure suas variáveis de ambiente para conexão com o banco e com o broker MQTT
cp .env.example .env
vi .env
```
```bash
# crie a estrutura do banco
php artisan migrate
# instale e compile as dependências do front-end
npm i && npm run dev
```

Este comando vai gerar o processo que cuidará do recebimento de mensagens dos alarmes, por isso deverá estar sempre rodando.
```bash
php artisan mqtt:subscribe
```
> Nota: Recomenda-se o uso de um supervisor como o supervisord.

## Configuração
