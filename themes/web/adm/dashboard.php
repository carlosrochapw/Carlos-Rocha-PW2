<?php $this->layout('adm/_theme', ['title'=>'Painel']) ?>

<?php $this->start('conteudo') ?>
<div class="dashboard-container">
  <h2>Visão Geral do Painel</h2>
  <ul>
    <li>Submissões pendentes: <strong><?= $pendingCount ?></strong></li>
    <li>Jogos aprovados: <strong><?= $totalGames ?></strong></li>
  </ul>
</div>
<?php $this->end() ?>
