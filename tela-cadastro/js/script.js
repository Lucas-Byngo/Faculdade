document.getElementById("formulario").addEventListener("submit", function (formulario) {
  formulario.preventDefault()
  var botaoClicado = formulario.submitter
  if (botaoClicado.value == "Limpar") {
    limparTodosInputsELabelsErros()
    return
  }

  document.getElementById('nome').addEventListener('input', function () {
    limparMensagemErros('nome-erro')
  })
  document.getElementById('nome-materno').addEventListener('input', function () {
    limparMensagemErros('nome-materno-erro')
  })
  document.getElementById('email').addEventListener('input', function () {
    limparMensagemErros('email-erro')
  })
  document.getElementById('telefone').addEventListener('input', function () {
    limparMensagemErros('telefone-erro')
  })
  document.getElementById('senha').addEventListener('input', function () {
    limparMensagemErros('senha-erro')
  })
  document.getElementById('telefone-fixo').addEventListener('input', function () {
    limparMensagemErros('telefone-fixo-erro')
  })

  var nome = document.getElementById("nome").value
  var nomeMaterno = document.getElementById("nome-materno").value
  var email = document.getElementById("email").value
  var telefone = document.getElementById("telefone").value
  var senha = document.getElementById("senha").value
  var confirmarSenha = document.getElementById("confirmar-senha").value
  var cpf = document.getElementById("cpf").value
  var telefoneFixo = document.getElementById("telefone-fixo").value

  var erros = [];

  erros.push({
    'label': 'nome-erro',
    'mensagem': validarNome(nome)
  })
  erros.push({
    'label': 'nome-materno-erro',
    'mensagem': validarNomeMaterno(nomeMaterno)
  })
  erros.push({
    'label': 'email-erro',
    'mensagem': validarEmail(email)
  })
  erros.push({
    'label': 'telefone-erro',
    'mensagem': validarTelefone(telefone)
  })
  erros.push({
    'label': 'senha-erro',
    'mensagem': validarSenhas(senha, confirmarSenha)
  })

  erros.push({
    'label': 'telefone-fixo-erro',
    'mensagem': validarTelefone(telefoneFixo)
  })

  lancarErros(erros)
});

const inputCep = document.getElementById('cep')

inputCep.addEventListener('input', function () {
  limparMensagemErros('cep-erro')

  if (inputCep.value.length >= 8) {
    const cep = inputCep.value.replace(/\D/g, '');
    const erro = buscarEndereco(cep)
    if (erro && typeof erro === 'string') {
      var erros = [];

      erros.push({
        'label': 'cep-erro',
        'mensagem': erro
      })

      lancarErros(erros)
    }
  }
})