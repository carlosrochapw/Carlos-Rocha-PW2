<?php $this->layout('_theme', ['title' => 'Dashboard']) ?>

<?php $this->start('conteudo') ?>
<div class="dashboard-container">
  <h2>Bem-vindo, <?= $this->e($user) ?></h2>
  <p>Aqui você pode enviar novos jogos para aprovação:</p>
  <a class="btn" href="<?= site() ?>/app/submit">Enviar Jogo</a>
</div>
<?php $this->end() ?>
