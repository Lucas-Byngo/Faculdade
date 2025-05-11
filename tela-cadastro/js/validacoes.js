const regexNome = /^[a-zA-ZÀ-ÿ\s]+$/;
const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function validarNome(valor) {
    if (!valor || valor.trim() === '') {
        return 'O nome precisa ser preenchido.'
    }
    if (!regexNome.test(valor)) {
        return 'O nome só pode conter letras.'
    }

    if (valor.length < 15 || valor.length > 80) {
        return 'O nome precisa ter minimo 15 e máximo 80 caracteres.'
    }

    return null;
}

function validarNomeMaterno(valor) {
    if (!valor || valor.trim() === '') {
        return 'O nome materno precisa ser preenchido.'
    }
    if (!regexNome.test(valor)) {
        return 'O nome materno só pode conter letras.'
    }

    return null;
}

function validarEmail(valor) {
    if (!valor || valor.trim() === '') {
        return 'O e-mail precisa ser preenchido.';
    }
    if (!regexEmail.test(valor)) {
        return 'O e-mail está invalido.';
    }

    return null;
}

function validarTelefone(valor) {
    if (!valor || valor.trim() === '') {
        return 'O telefone precisa ser preenchido.'
    }
    if (!regexTelefone.test(valor)) {
        return 'O telefone está invalido.'
    }

    return null;
}

function validarSenhas(senha, confirmarSenha) {
    if (!senha || !confirmarSenha || senha.trim() === '') {
        return 'Por favor, preencha senha e confirmar senha.'
    }
    const letras = senha.match(/[A-Za-z]/g);
    if (!letras || letras.length < 8) {
        return 'A senha deve ter no minimo 8 letras'
    }
    if (senha !== confirmarSenha) {
        return 'As senhas não coincidem.'
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

function buscarEndereco(cep) {
    if (cep.length !== 8) {
        return 'CEP inválido! Deve conter 8 dígitos.';
    }

    const url = `https://viacep.com.br/ws/${cep}/json/`;

    return fetch(url)
        .then(res => {
            if (!res.ok) throw new Error('Cep ao consultar')
            return res.json();
        })
        .then(data => {
            if (data.erro) throw new Error('CEP não encontrado')

            document.getElementById('rua').value = data.logradouro || '';
            document.getElementById('bairro').value = data.bairro || '';
            document.getElementById('cidade').value = data.localidade || '';
            document.getElementById('estado').value = data.uf || '';
        })
        .catch(error => {
            document.getElementById('rua').value = '';
            document.getElementById('bairro').value = '';
            document.getElementById('cidade').value = '';
            document.getElementById('estado').value = '';
            return error.message
        });
}