<?php $this->layout('_theme', ['title' => 'Catálogo']) ?>

<?php $this->start('conteudo') ?>
<h2 class="catalogo-titulo">Catálogo de Jogos</h2>

<div class="home-card">
  <?php foreach($games as $game): ?>
    <div class="jogo-card">
     
      <img src="<?= site() ?>/<?= $this->e($game->imagem) ?>" 
           alt="<?= $this->e($game->titulo) ?>">

     
      <div class="nome"><?= $this->e($game->titulo) ?></div>
      <div class="preco">R$ <?= number_format($game->preco, 2, ',', '.') ?></div>

    
      <a class="detalhes" href="<?= site() ?>/jogo/<?= $game->id ?>">
        Detalhes
      </a>
    </div>
  <?php endforeach; ?>
</div>
<?php $this->end() ?>
