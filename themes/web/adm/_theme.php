<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?= $this->e($title) ?> – Admin Indie Hub</title>
  <link rel="stylesheet" href="<?= site() ?>/assets/css/style.css?v=2">

</head>
<body>
  <?php if(session_status()===PHP_SESSION_NONE) session_start(); ?>

  <header>
    <div class="nav-container">
      <span class="logo">Indie Hub Admin</span>
      <ul class="nav-links">
        <li><a href="<?= site() ?>/adm">Dashboard</a></li>
        <li><a href="<?= site() ?>/adm/produtos">Submissões</a></li>
        <li><a href="<?= site() ?>/adm/jogos">Jogos Cadastrados</a></li>
        <li><a href="<?= site() ?>/logout">Logout</a></li>
      </ul>
    </div>
  </header>
  <main class="main-content">
    <?= $this->section('conteudo') ?>
  </main>

  <footer>
    &copy; <?= date('Y') ?> Indie Hub Admin
  </footer>
</body>
</html>
