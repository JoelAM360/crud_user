# CRUD de Usuários – Laravel

Projeto simples de CRUD (Create, Read, Update, Delete) de usuários desenvolvido em **Laravel**, com consumo de API via **AJAX (jQuery)** e feedback visual utilizando **SweetAlert**.

Este projeto foi criado como parte de um **teste técnico**.

---

## Tecnologias Utilizadas

- PHP 8+
- Laravel 10
- MySQL
- jQuery
- SweetAlert2
- HTML / CSS / JavaScript

---

## Funcionalidades

- Cadastro de usuários
- Listagem de usuários
- Edição de usuários
- Exclusão de usuários
- Validação de dados no backend
- Feedback visual de sucesso e erro
- Atualização dinâmica da tabela (sem recarregar a página)

---

## Pré-requisitos

Antes de começar, você precisa ter instalado em sua máquina:

- PHP >= 8.1
- Composer
- MySQL
- Git

---

## Passo a passo para rodar o projeto

### 1 Clonar o repositório
```bash
git https://github.com/JoelAM360/crud_user.git
cd seu-repositorio
```

---

### 2 Instalar as dependências do Laravel
```bash
composer install
```

---

### 3 Configurar o arquivo `.env`

Copie o arquivo de exemplo:
```bash
cp .env.example .env
```

Configure as variáveis de ambiente do banco de dados no arquivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_users
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4 Gerar a chave da aplicação
```bash
php artisan key:generate
```

---

### 5 Criar o banco de dados
Crie manualmente um banco de dados MySQL com o nome definido no `.env`:
```sql
CREATE DATABASE crud_users;
```

---

### 6 Rodar as migrations
```bash
php artisan migrate
```

---

### 7 Iniciar o servidor
```bash
php artisan serve
```

O projeto estará disponível em:
```
http://127.0.0.1:8000
```

---

## Rotas da API

| Método | Rota              | Descrição            |
|------|-------------------|----------------------|
| POST | /api/users        | Criar usuário        |
| PUT  | /api/users/{id}   | Atualizar usuário    |
| DELETE | /api/users/{id} | Excluir usuário      |

---

## Estrutura básica do projeto

```
app/
 └── Http/
     └── Controllers/
         └── UserController.php

resources/
 └── views/
     └── welcome.blade.php

public/
 └── assets/
     └── style.css
     └── javascript.js
```

---

## Observações

- O projeto foi mantido propositalmente simples, focando em clareza, organização e boas práticas.
- Não foram utilizadas arquiteturas avançadas, pois o objetivo é um CRUD básico.
- Ideal para fins de aprendizado ou avaliação técnica.

---

##  Autor

Desenvolvido por **Joel Malamba**  
Email: joeybraen45@gmail.com  
GitHub: https://github.com/JoelAM360  

---

## Licença

Este projeto é de uso livre para fins educacionais.
