$(document).ready(function () {

    // -------------------------------
    // Funções de manipulação da tabela
    // -------------------------------

    function addUserToTable(user) {
        $('#userTableBody').append(`
            <tr data-id="${user.id}">
                <td class="user-name">${user.name}</td>
                <td class="user-email">${user.email}</td>
                <td class="user-phone">${user.phone}</td>
                <td class="actions">
                    <button class="btn-edit" data-id="${user.id}">Editar</button>
                    <button class="btn-delete" data-id="${user.id}">Excluir</button>
                </td>
            </tr>
        `);
    }

    function updateUserInTable(user) {
        const row = $(`tr[data-id='${user.id}']`);
        row.find('td:eq(0)').text(user.name);
        row.find('td:eq(1)').text(user.email);
        row.find('td:eq(2)').text(user.phone);
    }

    function resetForm() {
        $('#userForm')[0].reset();
        $('#btn-cancel-edit').hide();
        $('#btn-save').text('Cadastrar').removeData('id');
        $('#title').text('Cadastrar Novo Usuário');
    }

    // -------------------------------
    // Função AJAX genérica
    // -------------------------------
    function requestAjax({ url, method = 'GET', data = {}, successMessage = null, callback = null }) {
        Swal.fire({
            title: 'Processando...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url, type: method, data, dataType: 'json',
            success: function (response, textStatus, xhr) {
                Swal.close();

                if (response.message && successMessage) {
                    Swal.fire({ icon: 'success', title: successMessage, timer: 2000, showConfirmButton: false });
                }

                if (callback) callback(response, xhr);
            },
            error: function (xhr) {
                Swal.close();
                const message = xhr.responseJSON?.message || 'Erro inesperado';
                Swal.fire({ icon: 'error', title: 'Erro', text: message });
            }
        });
    }

    // -------------------------------
    // Cadastrar usuário
    // -------------------------------
    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        const user = {
            name: $('#name').val(),
            email: $('#email').val(),
            phone: $('#phone').val()
        };

        const userId = $('#btn-save').data('id');
        if (userId) {
            // Update
            requestAjax({
                url: `api/users/${userId}`,
                method: 'PUT',
                data: user,
                successMessage: `Usuário ${user.name} atualizado com sucesso!`,
                callback: function (response) {
                    if (response.data) updateUserInTable(response.data);
                    resetForm();
                }
            });
        } else {
            // Create
            requestAjax({
                url: 'api/users',
                method: 'POST',
                data: user,
                successMessage: `Usuário ${user.name} cadastrado com sucesso!`,
                callback: function (response) {
                    if (response.data) addUserToTable(response.data);
                    resetForm();
                }
            });
        }
    });

    // -------------------------------
    // Editar usuário
    // -------------------------------
    $(document).on('click', '.btn-edit', function () {
        const row = $(this).closest('tr');
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const phone = $(this).data('phone');

        $('#name').val(name);
        $('#email').val(email);
        $('#phone').val(phone);

        $('#btn-save').text('Salvar Alterações').data('id', id);
        $('#btn-cancel-edit').show();
        $('#title').text('Editar Usuário');
    });

    // -------------------------------
    // Cancelar edição
    // -------------------------------
    $('#btn-cancel-edit').on('click', resetForm);

    // -------------------------------
    // Excluir usuário
    // -------------------------------
    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        const row = $(this).closest('tr');

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Essa ação não pode ser desfeita!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                requestAjax({
                    url: `api/users/${id}`,
                    method: 'DELETE',
                    successMessage: 'Usuário excluído com sucesso!',
                    callback: () => row.remove()
                });
            }
        });
    });

});
