<?php $this->layout('adm/_theme', ['title' => 'Cadastrar Jogo']); ?>
<?php $this->start('conteudo'); ?>
<div class="submissao-container">
  <h2>Cadastrar Novo Jogo</h2>
  <form method="post" action="<?= site() ?>/adm/jogos/criar" enctype="multipart/form-data">
    <label>Título:<br>
      <input type="text" name="titulo" required>
    </label><br><br>
    <label>Descrição:<br>
      <textarea name="descricao" rows="5" required></textarea>
    </label><br><br>
    <label>Preço:<br>
      <input type="number" name="preco" step="0.01" min="0" required>
    </label><br><br>
    <label>Imagem:<br>
      <input type="file" name="imagem" accept="image/*" required>
    </label><br><br>
    <button type="submit">Cadastrar</button>
  </form>
</div>
<?php $this->end(); ?>
