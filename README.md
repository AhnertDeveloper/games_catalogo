# Catálogo de Games

Este projeto é um catálogo de games desenvolvido em Laravel, com upload e exibição de imagens, integração com PostgreSQL e suporte a Docker.

## Pré-requisitos

- PHP >= 7.2
- Composer
- Node.js e npm
- Docker e Docker Compose (opcional, mas recomendado)

## Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/seu-usuario/games_catalogo.git
   cd games_catalogo/catalogo
   ```

2. Instale as dependências do PHP:

   ```bash
   composer install
   ```

3. Instale as dependências do Node.js:

   ```bash
   npm install && npm run dev
   ```

4. Copie o arquivo de ambiente:

   ```bash
   cp .env.example .env
   ```

5. Configure o arquivo `.env` com os dados do seu banco PostgreSQL (ou use o Docker Compose).

6. Gere a chave da aplicação:

   ```bash
   php artisan key:generate
   ```

7. Rode as migrations:

   ```bash
   php artisan migrate
   ```

8. Crie o link simbólico para o storage:

   ```bash
   php artisan storage:link
   ```

## Utilizando com Docker

1. Suba os containers:

   ```bash
   docker-compose up -d
   ```

2. Acesse o container do app para rodar comandos artisan, se necessário:

   ```bash
   docker exec -it nome_do_container_app bash
   php artisan migrate
   php artisan storage:link
   ```

## Acessando o Projeto

- Acesse via navegador: [http://localhost:8000](http://localhost:8000) ou [http://localhost:8080](http://localhost:8080) (dependendo do seu Docker Compose).

## Observações

- As imagens dos games são salvas em `storage/app/public/games` e acessadas via `public/storage/games`.
- O upload e exibição das imagens está padronizado em todas as views.
- O banco de dados padrão é PostgreSQL, mas pode ser adaptado para outros.
- O diretório principal do projeto agora se chama `catalogo` (ajuste caminhos e volumes se necessário).
- Se mudar o nome da pasta, atualize os caminhos em `docker-compose.yml` e outros arquivos de configuração.
- Para rodar comandos artisan, entre na pasta `laravel`.

## Scripts Úteis

- Rodar migrations: `php artisan migrate`
- Criar link do storage: `php artisan storage:link`
- Subir Docker: `docker-compose up -d`
- Parar containers: `docker-compose down`
- Acessar o container do app: `docker exec -it <nome_do_container> bash`

---

Se tiver dúvidas, consulte os arquivos de configuração ou abra uma issue.
