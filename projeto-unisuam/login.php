<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - GiroGeek</title>
  <link rel="stylesheet" href="css/style.css">
  <script defer src="js/script.js"></script>
  <script defer src="js/login.js"></script>
</head>

<body>
  <?php
    include 'components/header.php';
  ?>

  <main>
    <div class="form-container">
      <h2>Login</h2>
      <form id="loginForm">
        <input type="email" id="loginEmail" placeholder="Email" required>
        <input type="password" id="loginSenha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
        <p>Não tem conta? <a href="cadastro.php">Cadastre-se</a></p>
        <p><a href="resetSenha.html" id="resetSenhaBtn">Esqueci a senha</a></p>

      </form>
    </div>
  </main>

  <!-- Modal 2FA -->
  <div id="twofaModal" class="modal">
    <div class="modal-content">
      <span class="close" id="twofaClose">&times;</span>
      <h2>Verificação de Segurança</h2>
      <p id="twofaQuestion"></p>
      <div class="form-group">
        <input type="text" id="twofaAnswer" placeholder="Digite sua resposta" />
      </div>
      <button id="twofaSubmit" class="btn-primary">Enviar</button>
    </div>
  </div>

  <?php
    include 'components/footer.php'
  ?>
</body>

</html>
