const pathname = window.location.pathname
const nameProject = pathname.split("/")[1]
const urlBaseBackEnd = window.location.origin + '/' + nameProject +'/backend/service/'

//Cadastro
const cadastroForm = document.getElementById("cadastroForm");
if (cadastroForm) {
    cadastroForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const nome = document.getElementById("nome").value.trim();
        const email = document.getElementById("email").value.trim();
        const senha = document.getElementById("senha").value.trim();
        const confSenha = document.getElementById("confSenha").value.trim();

        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexEmail.test(email)) {
            alert("Digite um e-mail válido!");
            return;
        }

        if (senha.length < 6) {
            alert("A senha precisa ter no mínimo 6 caracteres!");
            return;
        }

        if (senha !== confSenha) {
            alert("As senhas não coincidem!");
            return;
        }

        const dadosParaEnviar = { name: nome, email, password: senha };

        fetch(urlBaseBackEnd + 'create-user.php', {
            method: 'POST',
            body: JSON.stringify(dadosParaEnviar),
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            if (data.sucess == true) {
                window.location.href = "login.php";
            }
        })
        .catch(err => {
            console.error(err);
            alert("Erro ao cadastrar usuário. Tente novamente.");
        });
    });
}
