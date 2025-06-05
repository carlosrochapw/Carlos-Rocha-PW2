<?php $this->layout('_theme', ['title' => 'Enviar Jogo']) ?>

<?php $this->start('conteudo') ?>
<div class="submissao-container">
  <h2>Enviar Novo Jogo</h2>
  <form action="<?= site() ?>/app/submit" method="post" enctype="multipart/form-data">
    <label>Título:</label>
    <input type="text" name="titulo" required>

    <label>Descrição:</label>
    <textarea name="descricao" required></textarea>

    <label>Preço (R$):</label>
    <input type="number" step="0.01" name="preco" required>

    <label>Imagem:</label>
    <input type="file" name="imagem" accept="image/*">

    <button class="btn" type="submit">Enviar para Aprovação</button>
  </form>
</div>
<?php $this->end() ?>
