<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - GiroGeek</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/script.js"></script>
    <script defer src="js/admin.js"></script>
</head>

<body>
    <?php
    include 'components/header.php';
    ?>
    <main>
        <table class="table-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Data criada</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="user-table-body">
            </tbody>
        </table>
    </main>

    <!-- Modal de Edição -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Editar Usuário</h2>
            <form id="editForm">
                <input type="hidden" id="editId">
                <div class="form-group">
                    <label for="editNome">Nome:</label>
                    <input type="text" id="editNome" name="nome" required>
                </div>
                <div class="form-group">
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="email" required>
                </div>
                <div class="form-group">
                    <label for="editTipo">Tipo:</label>
                    <select id="editTipo" name="tipo">
                        <option value="admin">Admin</option>
                        <option value="user">Usuário</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editSenha">Nova Senha (deixe em branco para não alterar):</label>
                    <input type="password" id="editSenha" name="senha" minlength="6">
                </div>
                <div class="form-group">
                    <label for="editConfirmSenha">Confirmar Nova Senha:</label>
                    <input type="password" id="editConfirmSenha" name="confirmSenha" minlength="6">
                </div>
                <button type="submit" class="btn-primary">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <?php
    include 'components/footer.php'
    ?>
</body>

</html>
