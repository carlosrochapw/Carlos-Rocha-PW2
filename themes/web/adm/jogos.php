<?php $this->layout('adm/_theme', ['title' => 'Jogos Cadastrados']) ?>

<?php $this->start('conteudo') ?>
<div class="submissao-container">
  <h2>Jogos Cadastrados</h2>
  <p>
    <a href="#form-criar-jogo" class="btn">+ Cadastrar Novo Jogo</a>
  </p>
  <div style="overflow-x:auto;width:100%">
    <table class="table-admin" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Preço</th>
          <th>Criado Por</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($games as $game): ?>
          <tr>
            <td><?= $game->id ?></td>
            <td><?= $this->e($game->titulo) ?></td>
            <td>R$ <?= number_format($game->preco, 2, ',', '.') ?></td>
            <td><?= $game->criado_por ?></td>
            <td>
              <a class="btn" href="<?= site() ?>/adm/jogos/editar/<?= $game->id ?>">Editar</a>
              <form method="POST" action="<?= site() ?>/adm/jogos/deletar" style="display:inline">
                <input type="hidden" name="id" value="<?= $game->id ?>">
                <button class="btn" onclick="return confirm('Tem certeza que deseja remover este jogo?')">
                  Remover
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <hr>
  <section id="form-criar-jogo">
    <h2>Cadastrar Novo Jogo</h2>
    <form action="<?= site() ?>/adm/jogos/criar" method="post" enctype="multipart/form-data">
      <label>
        Título:<br>
        <input type="text" name="titulo" required>
      </label><br><br>
      <label>
        Descrição:<br>
        <textarea name="descricao" rows="5" required></textarea>
      </label><br><br>
      <label>
        Preço:<br>
        <input type="number" name="preco" step="0.01" min="0" required>
      </label><br><br>
      <label>
        Imagem:<br>
        <input type="file" name="imagem" accept="image/*" required>
      </label><br><br>
      <button type="submit" class="btn">Cadastrar</button>
    </form>
  </section>
</div>
<?php $this->end() ?>
