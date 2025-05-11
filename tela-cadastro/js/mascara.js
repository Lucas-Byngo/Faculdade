const cpfInput = document.getElementById('cpf')

cpfInput.addEventListener('input', () => {
  let value = cpfInput.value.replace(/\D/g, '') // Remove tudo que não for número

  // Limita a 11 dígitos
  value = value.slice(0, 11)

  // Aplica a máscara: 000.000.000-00
  if (value.length > 9) {
    value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{1,2})/, "$1.$2.$3-$4")
  } else if (value.length > 6) {
    value = value.replace(/(\d{3})(\d{3})(\d{1,3})/, "$1.$2.$3")
  } else if (value.length > 3) {
    value = value.replace(/(\d{3})(\d{1,3})/, "$1.$2")
  }

  cpfInput.value = value
})

function validarTelefoneInput(telefoneInput) {
  telefoneInput.addEventListener("input", () => {
    let valor = telefoneInput.value.replace(/\D/g, '')

    if (valor.length > 11) valor = valor.slice(0, 11) // Limita a 11 dígitos

    if (valor.length <= 10) {
      // Fixo: (00) 0000-0000
      valor = valor.replace(/(\d{2})(\d{4})(\d{0,4})/, "($1) $2-$3")
    } else {
      // Celular: (00) 00000-0000
      valor = valor.replace(/(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3")
    }

    telefoneInput.value = valor
  })
}

const telefoneInput = document.getElementById("telefone")
validarTelefoneInput(telefoneInput)

const telefoneFixoInput = document.getElementById("telefone-fixo")
validarTelefoneInput(telefoneFixoInput)