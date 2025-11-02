<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro - GiroGeek</title>
  <link rel="stylesheet" href="css/style.css">
  <script defer src="js/script.js"></script>
  <script defer src="js/create.js"></script>
</head>

<body>
  <?php
    include 'components/header.php';
  ?>

  <main>
    <div class="form-container">
      <h2>Cadastro</h2>
      <form id="cadastroForm">
        <input type="text" id="nome" placeholder="Nome completo" required>
        <input type="email" id="email" placeholder="Email" required>
        <input type="password" id="senha" placeholder="Senha" required>
        <input type="password" id="confSenha" placeholder="Confirmar senha" required>
        <button type="submit">Cadastrar</button>
        <p>Já tem conta? <a href="login.php">Faça login</a></p>
      </form>
    </div>
  </main>

  <?php
    include 'components/footer.php'
  ?>
</body>

</html>
