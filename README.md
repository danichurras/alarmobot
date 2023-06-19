## Sobre o Alarmobot
Essa aplicação Laravel serve como interface de usuário para controle de usuários e gerenciamento de alarmes. A aplicação se comunica via MQTT com um broker e o broker troca informações com o ESP8266, podendo enviar comandos para arme, desarme e silenciamento do alarme. O ESP8266 se comunica com o mesmo broker para enviar um alerta de que o alarme foi disparado.

## Instalação

```bash
# troque o diretório para seu espaço de trabalho desejado
cd path_para_seu_workspace
# clone o repositório
git clone https://github.com/DanielChavesSimao/alarmobot.git
# vá para a pasta raíz da aplicação
cd alarmobot
# instale as dependências do composer
composer install
# configure suas variáveis de ambiente para conexão com o banco e com o broker MQTT
cp .env.example .env
vi .env
# crie a estrutura do banco
php artisan migrate
# instale e compile as dependências do front-end
npm i
npm run dev

# após compilado caso precise de espaço no servidor
# pode apagar a pasta de pacotes de dependências do node
rm -rfd node_modules
```

## Configuração
