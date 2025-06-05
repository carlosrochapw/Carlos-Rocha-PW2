<?php $this->layout('_theme', ['title' => 'Erro']) ?>

<?php $this->start('conteudo') ?>
<h2>Erro <?= $this->e($error) ?></h2>
<p>Ocorreu um erro ao processar sua requisição.</p>
<?php $this->end() ?>
