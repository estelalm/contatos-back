# Gerenciamento de Contatos

Este repositório permite o gerenciamento de contatos, incluindo cadastro, listagem, atualização e remoção de contatos.

## Requisitos

Antes de rodar o projeto, certifique-se de que seu ambiente cumpre os seguintes requisitos:

- PHP 7 ou superior;
- Extensão PDO habilitada no PHP;
- MySQL 5 ou superior;

## Clone o repositório

1. Clone o repositório:
   ```sh
   git clone https://github.com/estelalm/contatos-back.git
   cd contatos-back
   ```

## Configure do Banco de Dados

1. Importe o arquivo `contatos.sql` presente no repositório.

1. Crie o banco de dados localmente no MySQL:
   ```sql
   CREATE DATABASE contatos_db;
   ```

2. Importe o arquivo `contatos.sql` (presente no repositório) para criar a banco de dados:
   ```sh
   mysql -u root -p contatos_db < contatos.sql
   ```
   (Caso tenha um usuário diferente de `root`, substitua no comando.)

3. Configure o acesso ao banco no arquivo `config/database.php`:

   ```php
   class Database {
       private $host = 'localhost';
       private $db = 'contatos_db';
       private $port = 3306;
       private $user = 'seu_usuario';
       private $pass = 'sua_senha';
   }
   ```

## Inicie a aplicação

1. No terminal, inicie o servidor local do PHP:
   ```sh
   php -S localhost:8000 -t public
   ```

2. A API estará rodando em: `http://localhost:8000`

## Endpoints

| Endpoint              | Método | Descrição                            |
|----------------------|--------|--------------------------------|
| `/contatos`         | GET    | Lista todos os contatos       |
| `/contatos/{id}`    | GET    | Busca um contato por ID       |
| `/contatos`         | POST   | Cria um novo contato          |
| `/contatos/{id}`    | PUT    | Atualiza um contato existente |
| `/contatos/{id}`    | DELETE | Exclui um contato             |

### Exemplo de resposta da requisição GET

  ```json
  [
  {
    "id": "1",
    "nome": "Maria Silva",
    "email": "mariasilva@gmail.com",
    "data_nascimento": "1980-01-01",
    "celular": "11911112222",
    "profissao": "Analista de Dados",
    "telefone": "1111112222",
    "enviar_sms": "0",
    "enviar_email": "0",
    "possui_whatsapp": "1"
  }
  ]
  ```

### Exemplo de JSON válido para as requisições POST e PUT

  ```json
  {
    "nome": "Maria Silva",
    "email": "mariasilva@gmail.com",
    "data_nascimento": "1980-01-01",
    "celular": "11911112222",
    "profissao": "Analista de Dados",
    "telefone": "1111112222",
    "enviar_sms": "0",
    "enviar_email": "0",
    "possui_whatsapp": "1"
  }
  ```


## Front-end

- Esse repositório faz parte de uma aplicação completa de gerenciamento de contatos, para testar a integração, é necessário rodar o backend junto ao Frontend, encontrado no seguinte repositório:

[FrontEnd](https://github.com/estelalm/contatos)

---

Se tiver dúvidas, entre em contato.
