<?php $this->layout('adm/_theme', ['title' => 'Editar Jogo']) ?>

<?php $this->start('conteudo') ?>
<h2>Editar Jogo</h2>

<form action="<?= site() ?>/adm/jogos/atualizar" method="post" enctype="multipart/form-data">
  
  <input type="hidden" name="id" value="<?= $this->e($game->id) ?>">

  <label>
    Título:<br>
    <input type="text" name="titulo" 
           value="<?= $this->e($game->titulo) ?>" required>
  </label><br><br>

  <label>
    Descrição:<br>
    <textarea name="descricao" rows="5" required><?= $this->e($game->descricao) ?></textarea>
  </label><br><br>

  <label>
    Preço (R$):<br>
    <input type="number" name="preco" step="0.01" 
           value="<?= number_format($game->preco, 2, '.', '') ?>" required>
  </label><br><br>

  <label>
    Imagem atual:<br>
    <img src="<?= site() ?>/<?= $this->e($game->imagem) ?>" 
         alt="Imagem de <?= $this->e($game->titulo) ?>" 
         style="max-width:200px; display:block; margin-bottom:10px;">
  </label><br>

  <label>
    Substituir imagem (opcional):<br>
    <input type="file" name="imagem" accept="image/*">
  </label><br><br>

  <button type="submit" class="btn">Salvar Alterações</button>
  <a href="<?= site() ?>/adm/jogos" class="btn">Cancelar</a>
</form>
<?php $this->end() ?>
