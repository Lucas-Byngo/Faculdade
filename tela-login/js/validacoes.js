function validarSenhas(senha) {
    if (!senha || !confirmarSenha || senha.trim() === '') {
        return 'Por favor, preencha senha e confirmar senha.'
    }
    const letras = senha.match(/[A-Za-z]/g);
    if (!letras || letras.length < 8) {
        return 'A senha deve ter no minimo 8 letras'
    }

    return null;
}

function lancarErros(erros) {
    for (let erro in erros) {
        if (erros[erro].mensagem) {
            document.getElementById(erros[erro].label).innerText = erros[erro].mensagem
        }
    }
}

function limparMensagemErros(label) {
    document.getElementById(label).innerText = '';
}

function limparTodosInputsELabelsErros() {
    let campos = document.querySelectorAll('#formulario .form-row .form-group input')
    campos.forEach(campo => campo.value = '')

    let errors = document.querySelectorAll('#formulario .form-row .form-group .erro');
    errors.forEach(error => error.innerHTML = '')
}