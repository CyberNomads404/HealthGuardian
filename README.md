# 🩺 HealthMonitor API

**HealthGuardian API** é uma aplicação desenvolvida em Laravel que permite o registro e acompanhamento de dados de saúde, como frequência cardíaca, pressão arterial, atividades físicas e hábitos alimentares. Esta API foi criada para fornecer uma interface robusta para gerenciar dados de saúde, permitindo fácil integração com qualquer frontend.

## 📚 Tabela de Conteúdos
- [📖 Visão Geral](#-visão-geral)
- [🛠 Tecnologias](#-tecnologias)
- [⚙️ Configuração](#%EF%B8%8F-configuração)
  - [📋 Pré-requisitos](#-pré-requisitos)
  - [⬇️ Instalação](#%EF%B8%8F-instalação)
  - [🚀 Executando Localmente](#-executando-localmente)
- [🎨 Usando a API](#-usando-a-api)
- [📒 Sobre](#-sobre)

## 📖 Visão Geral

A **HealthMonitor API** facilita o registro e acompanhamento de dados de saúde, fornecendo endpoints que permitem o gerenciamento de informações essenciais, como frequência cardíaca, pressão arterial, atividades físicas e hábitos alimentares. A API é projetada para ser flexível e fácil de integrar a diferentes frontends.

### Diagrama de Classe 
![HealthMonitor  drawio](https://github.com/user-attachments/assets/24c550fc-eab0-42e7-a86d-febd254bd533)

## 🛠 Tecnologias

- **Laravel**: Framework PHP para desenvolvimento da API.
- **MySQL**: Banco de dados relacional para armazenar os registros de saúde.
- **JWT**: Autenticação para proteger os dados dos usuários.

## ⚙️ Configuração

### 📋 Pré-requisitos

- PHP 8.1+
- Composer
- MySQL

### ⬇️ Instalação

1. **Clone o repositório:**
    ```bash
    git clone https://github.com/seuusuario/healthmonitor-api.git
    cd healthmonitor-api
    ```

2. **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

3. **Crie o arquivo `.env`:**
    ```bash
    cp .env.example .env
    ```

4. **Configure as variáveis de ambiente no arquivo `.env`** para o banco de dados, chave da aplicação e outras configurações.

5. **Gere a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```

6. **Execute as migrações do banco de dados:**
    ```bash
    php artisan migrate
    ```

### 🚀 Executando Localmente

1. **Inicie o servidor de desenvolvimento:**
    ```bash
    php artisan serve
    ```

2. **A API estará disponível em `http://localhost:8000`.**


### 🐋 DOCKER

1. Copie os arquivos docker-compose.yml, Dockerfile e o diretório docker/ para o seu projeto
    ```sh
    cp -rf setup-docker-laravel/* app-laravel/
    ```
    ```sh
    sudo chmod -R 777 app-laravel
    cd app-laravel/
    ```
2. Instale as dependências do projeto
   ```sh
   docker-compose exec --user root app composer install
   ```
3. Gerar a key do projeto Laravel
   ```sh
    docker-compose exec --user root app php artisan key:generate
   ```
4. Gerar o Banco de Dados
   ```sh
    docker-compose exec --user root app php artisan migrate
   ```


## 🎨 Usando a API

1. **Autenticação:**
   - Utilize os endpoints de autenticação para registrar usuários e gerenciar sessões com JWT.

2. **Gerenciamento de Dados de Saúde:**
   - Utilize os endpoints para registrar e consultar dados de saúde, como frequência cardíaca, pressão arterial, atividades físicas e hábitos alimentares.

3. **Documentação:**
   - Utilize a documentação da API (como Swagger ou Postman) para ver todos os endpoints disponíveis e seus detalhes.

## 📒 Sobre

Obrigado por utilizar o **HealthMonitor API**! Se você tiver dúvidas, sugestões ou encontrar algum problema, entre em contato através de pedro.henrique.martins404@gmail.com.
