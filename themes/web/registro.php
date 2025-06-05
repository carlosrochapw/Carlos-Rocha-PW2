<?php $this->layout('_theme', ['title' => 'Registrar']) ?>

<?php $this->start('conteudo') ?>
<section class="tudo">
    <i></i><i></i><i></i>
    <div class="logar">
        <h1>Crie sua conta</h1>
       <form action="<?= site() ?>/registro" method="post">
            <div class="conectoresdecomputadores">
                <input type="text" name="nome" placeholder="Seu Nome" required aria-label="Seu Nome">
            </div>
            <div class="conectoresdecomputadores">
                <input type="email" name="email" placeholder="Seu Email" required aria-label="Seu Email">
            </div>
            <div class="conectoresdecomputadores">
                <input type="password" name="senha" placeholder="Senha" required aria-label="Senha">
            </div>
            <div class="conectoresdecomputadores">
                <input type="password" name="senha_confirm" placeholder="Confirme a Senha" required aria-label="Confirme a Senha">
            </div>
            <div class="conectoresdecomputadores">
                <button type="submit">Registrar</button>
            </div>
        </form>
    </div>
</section>
<?php $this->end() ?>
