<?php $this->layout('adm/_theme', ['title' => 'Revisar Jogos']) ?>

<?php $this->start('conteudo') ?>
<h2>Submissões Pendentes</h2>
<?php if(empty($pending)): ?>
  <p>Não há jogos pendentes.</p>
<?php else: ?>
  <table>
    <thead>
      <tr>
        <th>Título</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Usuário</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($pending as $sub): ?>
        <tr>
          <td><?= $this->e($sub->titulo) ?></td>
          <td><?= nl2br($this->e($sub->descricao)) ?></td>
          <td>R$ <?= number_format($sub->preco, 2, ',', '.') ?></td>
          <td><?= $this->e($sub->usuario) ?></td>
          <td>
            <form action="<?= site() ?>/adm/produtos/aceitar/<?= $sub->id ?>" method="post" style="display:inline">
              <button class="btn">Aceitar</button>
            </form>
            <form action="<?= site() ?>/adm/produtos/rejeitar/<?= $sub->id ?>" method="post" style="display:inline">
              <button class="btn btn-secondary">Rejeitar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>
<?php $this->end() ?>
