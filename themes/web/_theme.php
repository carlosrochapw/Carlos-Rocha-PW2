<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $this->e($title) ?> – Indie Hub</title>
 <link rel="stylesheet" href="<?= site() ?>/assets/css/style.css?v=2">

</head>
<body>
  <?php
 
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  ?>
  <div class="animated-bg">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
  </div>
  <header>
    <div class="nav-container">
      <span class="logo">Indie Hub</span>
      <ul class="nav-links">
        <li><a href="<?= site() ?>/">Catálogo</a></li>
        <li><a href="<?= site() ?>/sobre">Sobre</a></li>
        <li><a href="<?= site() ?>/faq">FAQ</a></li>
        <li><a href="<?= site() ?>/carrinho">Carrinho</a></li>
        <?php if (!empty($_SESSION['user'])): ?>
          <li><a href="<?= site() ?>/app">Dashboard</a></li>
          <li><a href="<?= site() ?>/logout">Logout</a></li>
        <?php else: ?>
          <li class="nav-login-group">
            <button class="nav-login-btn">Entrar / Registrar</button>
            <div class="nav-login-dropdown">
              <a href="<?= site() ?>/login">Login</a>
              <a href="<?= site() ?>/registro">Registrar</a>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </header>

  <main class="main-content">
    <?= $this->section('conteudo') ?>
  </main>

  <footer>
    <p>&copy; <?= date("Y") ?> Indie Hub</p>
  </footer>

  <script src="<?= site() ?>/assets/js/app.js"></script>

  <?php if (isset($_GET['login'])): ?>
  <script>
      <?php if ($_GET['login'] === 'admin'): ?>
          alert('Login realizado com sucesso! Bem-vindo ao painel administrativo.');
      <?php elseif ($_GET['login'] === 'user'): ?>
          alert('Login realizado com sucesso! Bem-vindo(a) ao Indie Hub.');
      <?php endif; ?>
  </script>
  <?php endif; ?>
</body>
</html>
