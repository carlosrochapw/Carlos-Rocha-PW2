<?php $this->layout('_theme', ['title' => 'Login']) ?>

<?php $this->start('conteudo') ?>
<section class="tudo">
    <i></i><i></i><i></i>
    <div class="logar">
        <h1>Login</h1>
       <form action="<?= site() ?>/login" method="post">
            <div class="conectoresdecomputadores">
                <input type="text" name="email" placeholder="Usuário ou Email" required aria-label="Usuário ou Email">
            </div>
            <div class="conectoresdecomputadores">
                <input type="password" name="senha" placeholder="Senha" required aria-label="Senha">
            </div>
            <div class="conectoresdecomputadores">
                <button type="submit">Entrar</button>
            </div>
        </form>
    </div>
</section>
<?php $this->end() ?>
