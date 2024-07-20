# API de Consulta de CEP

Este projeto é uma API em PHP que consome a API do ViaCEP para obter informações de endereços a partir de um CEP fornecido e retorna os dados para o frontend.

## Funcionalidades

- Consulta de endereço através de um CEP.
- Utilização de Tokens para consumo da API
- Retorno dos dados de endereço em formato JSON.
- Front Simples para visualizar dados

## Tecnologias Utilizadas

- PHP 8+
- Laravel 11+
- Docker
- Composer
- cURL

## Requisitos

- PHP 8.1 ou superior
- Composer

## Extensões PHP Necessárias

Certifique-se de que as seguintes extensões PHP estão habilitadas no seu arquivo `php.ini`:

```ini
    extension=intl
    extension=curl
    extension=mbstring
    extension=pdo_sqlite
    extension=fileinfo
    extension=openssl
```

## Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/vinyvic/tradeup-back.git

2. Navegue até o diretório do projeto e execute o comando composer
   
   ```bash
   cd tradeup-back
   composer install

3. Copie o arquivo `.env.example` para `.env`:

    ```bash
    cp .env.example .env

4. Gere a chave da aplicação:

     ```bash
     php artisan key:generate

5. Com o banco de dados em execução, execute o comando de migração e preenchimento de tabelas:

   ```bash
   php artisan migrate --seed

6. Execute o comando para baixar as depdencias do front:
    ```bash
    npm install
    
7. Execute o comando gerar assets do front:
    ```bash
    npm run build

8. Inicie o servidor de desenvolvimento do Laravel:

    ```bash
    php artisan serve

9. Acesse a URL [http://127.0.0.1:8000](http://127.0.0.1:8000)
