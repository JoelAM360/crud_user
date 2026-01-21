<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>
    <nav>
        <h1>Gerenciamento de Usuários</h1>
    </nav>
    <div class="container">
        <!-- Formulário de Cadastro -->
        <div class="section" style="width: 450px;">
            <h2 class="title" id="title">Cadastrar Novo Usuário</h2>
            <form id="userForm">
                <div class="form-group">
                    <label for="name">Nome Completo:</label>
                    <input type="text" id="name" name="name" placeholder="Digite o nome completo" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="Digite o e-mail" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telefone:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Digite o telefone" required>
                </div>

                <div class="btns">
                    <button type="submit" class="btn" id="btn-save">Cadastrar</button>
                    <button type="button" class="btn" id="btn-cancel-edit" style="display: none;">Cancelar</button>
                </div>
            </form>
        </div>

        <!-- Listagem de Usuários -->
        <div class="section" style="width: 650px;">
            <h2 class="title">Lista de Usuários</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    @foreach ($users as $user)
                        <tr data-id="{{ $user->id }}">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td class="actions">
                                <button class="btn-edit" data-name="{{ $user->name }}"
                                    data-email="{{ $user->email }}" data-phone="{{ $user->phone }}"
                                    data-id="{{ $user->id }}">Editar</button>
                                <button class="btn-delete"
                                    data-id="{{ $user->id }}"
                                >Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/javascript.js') }}"></script>
</body>

</html>
