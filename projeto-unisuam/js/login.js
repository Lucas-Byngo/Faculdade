const pathname = window.location.pathname
const nameProject = pathname.split("/")[1]
const urlBaseBackEnd = window.location.origin + '/' + nameProject + '/backend/service/'

const $usuarioLogado = localStorage.getItem('usuario-logado');
if ($usuarioLogado) {
    window.location.href = "index.php";
}

const loginForm = document.getElementById("loginForm");
if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const email = document.getElementById("loginEmail").value.trim();
        const senha = document.getElementById("loginSenha").value.trim();

        const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!regexEmail.test(email)) {
            alert("E-mail inválido!");
            return;
        }

        if (senha.length < 6) {
            alert("Senha deve ter no mínimo 6 caracteres!");
            return;
        }

        const dadosParaEnviar = { email, password: senha };
        fetch(urlBaseBackEnd + 'login.php', {
            method: 'POST',
            body: JSON.stringify(dadosParaEnviar),
        })
        .then(res => res.json())
        .then(data => {
            // se 2FA requerido (admin)
            if (data.twofa_required) {
                const modal = document.getElementById('twofaModal');
                const questionP = document.getElementById('twofaQuestion');
                const answerInput = document.getElementById('twofaAnswer');
                const submitBtn = document.getElementById('twofaSubmit');
                const closeBtn = document.getElementById('twofaClose');

                // preencher dados
                modal.dataset.userId = data.user_id;
                modal.dataset.questionId = data.question.id;
                questionP.textContent = data.question.text || 'Pergunta de segurança';
                answerInput.value = '';

                // mostrar modal
                modal.style.display = 'block';

                // fechar
                closeBtn.onclick = () => { modal.style.display = 'none'; };
                window.onclick = (ev) => { if (ev.target == modal) modal.style.display = 'none'; };

                submitBtn.onclick = async () => {
                    const answer = answerInput.value.trim();
                    if (!answer) { alert('Informe a resposta.'); return; }

                    const payload = {
                        user_id: modal.dataset.userId,
                        question_id: modal.dataset.questionId,
                        answer: answer
                    };

                    try {
                        const resp = await fetch(urlBaseBackEnd + 'verify-2fa.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify(payload)
                        });
                        const verifyData = await resp.json();
                        if (verifyData.usuario) {
                            localStorage.removeItem('usuario-logado');
                            localStorage.setItem('user_logged', JSON.stringify(verifyData.usuario));
                            alert(`Bem-vindo, ${verifyData.usuario.nome}!`);
                            window.location.href = "index.php";
                        } else {
                            console.log(verifyData);
                            alert(verifyData.mensagem || 'Resposta incorreta.');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Erro ao verificar 2FA.');
                    }
                };

                return;
            }

            if (data.usuario) {
                localStorage.removeItem('usuario-logado');
                localStorage.setItem('user_logged', JSON.stringify(data.usuario));
                alert(`Bem-vindo, ${data.usuario.nome}!`);
                window.location.href = "index.php";
            } else {
                alert(data.mensagem || data.message || 'Erro ao fazer login.');
            }
        })
        .catch(err => {
            console.error(err);
            alert("Erro ao tentar logar. Tente novamente.");
        });
    });
}
