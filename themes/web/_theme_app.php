<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $this->e($title) ?> – Área do Usuário</title>
 <link rel="stylesheet" href="<?= site() ?>/assets/css/style.css?v=<?= time() ?>">.
</head>
<body>
  <header>
    <div class="nav-container">
      <span class="logo">Indie Hub – Usuário</span>
      <ul class="nav-links">
        <li><a href="<?= site() ?>/app">Dashboard</a></li>
        <li><a href="<?= site() ?>/app/submit">Enviar Jogo</a></li>
        <li><a href="<?= site() ?>/logout">Sair</a></li>
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

</body>
</html>
