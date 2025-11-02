const pathname = window.location.pathname
const nameProject = pathname.split("/")[1]
const urlBaseBackEnd = window.location.origin + '/' + nameProject + '/backend/service/'

var userLogged = localStorage.getItem('user_logged');
if (!userLogged) {
    window.location.href = "login.php";
}
userLogged = JSON.parse(userLogged);
if (userLogged.admin !== 1) {
    window.location.href = "index.php";
}

fetch(urlBaseBackEnd + 'get-user-all.php', {
    method: 'POST',
})
    .then(res => res.json())
    .then(data => {
        if (data.users) {
            const userTableBody = document.getElementById('user-table-body');
            data.users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.admin ? 'Administador' : 'Usuário'}</td>
                    <td>${user.created_at}</td>
                    <td>
                        <button class="edit-btn" data-id="${user.id}" 
                            data-name="${user.name}" 
                            data-email="${user.email}" 
                            data-admin="${user.admin}">Editar</button>
                        <button class="delete-btn" data-id="${user.id}">Excluir</button>
                    </td>
                `;
                userTableBody.appendChild(row);
            });
            reloadDeleteButtons();
            reloadEditButtons();
        } else {
            alert("Erro ao carregar usuários.");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Erro ao carregar usuários.");
    });

// Modal elements
const modal = document.getElementById('editModal');
const closeBtn = document.getElementsByClassName('close')[0];
const editForm = document.getElementById('editForm');

// Close modal when clicking X
closeBtn.onclick = function() {
    modal.style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

function reloadEditButtons() {
    Array.from(document.getElementsByClassName('edit-btn')).forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');
            const userEmail = button.getAttribute('data-email');
            const userAdmin = button.getAttribute('data-admin');

            // Preencher o formulário
            document.getElementById('editId').value = userId;
            document.getElementById('editNome').value = userName;
            document.getElementById('editEmail').value = userEmail;
            document.getElementById('editTipo').value = userAdmin === '1' ? 'admin' : 'user';

            // Mostrar o modal
            modal.style.display = 'block';
        });
    });
}

// Handle edit form submission
editForm.onsubmit = function(e) {
    e.preventDefault();
    const userId = document.getElementById('editId').value;
    const nome = document.getElementById('editNome').value;
    const email = document.getElementById('editEmail').value;
    const tipo = document.getElementById('editTipo').value;
    const senha = document.getElementById('editSenha').value;
    const confirmSenha = document.getElementById('editConfirmSenha').value;

    // Validação das senhas
    if (senha || confirmSenha) {
        if (senha !== confirmSenha) {
            alert('As senhas não coincidem!');
            return;
        }
        if (senha.length < 6) {
            alert('A senha deve ter pelo menos 6 caracteres!');
            return;
        }
    }

    fetch(urlBaseBackEnd + 'update-user.php', {
        method: 'PUT',
        body: JSON.stringify({
            id: userId,
            nome: nome,
            email: email,
            tipo: tipo,
            senha: senha || undefined
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert('Usuário atualizado com sucesso!');
            location.reload();
        } else {
            alert('Erro ao atualizar usuário: ' + (data.error || 'Erro desconhecido'));
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao atualizar usuário');
    });
}

function reloadDeleteButtons() {
    Array.from(document.getElementsByClassName('delete-btn')).forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.getAttribute('data-id');
            if (confirm('Tem certeza que deseja excluir este usuário?')) {
                fetch(urlBaseBackEnd + 'delete-user.php?id=' + userId, {})
                    .then(res => res.json())
                    .then(data => {
                        if (data.sucess) {
                            window.location.reload();
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert("Erro ao excluir usuário.");
                    });
            }
        });
    });
}
