```php
<?php $this->layout('_theme', ['title' => 'FAQ']) ?>

<?php $this->start('conteudo') ?>
<div class="centralizador">
    <h1>Perguntas Frequentes</h1>
    <div class="faq-item">
        <h2>O que é o Indie Hub?</h2>
        <p>O Indie Hub é uma plataforma online que promove jogos independentes, conectando desenvolvedores a jogadores e oferecendo um espaço para compra e interação.</p>
    </div>
    <div class="faq-item">
        <h2>Como posso registrar minha conta?</h2>
        <p>Para se registrar, clique em 'Registrar' no menu, preencha o formulário com seu nome, e-mail e senha, e envie. Após a aprovação, você poderá acessar sua conta.</p>
    </div>
    <div class="faq-item">
        <h2>Posso comprar jogos sem registro?</h2>
        <p>Não, o registro é necessário para realizar compras. Isso garante segurança nas transações e permite personalizar sua experiência.</p>
    </div>
    <div class="faq-item">
        <h2>Como funcionam os pagamentos?</h2>
        <p>Os pagamentos serão processados por uma plataforma segura (a ser implementada). Aceitaremos cartões de crédito e Pix, com opções de parcelamento.</p>
    </div>
    <div class="faq-item">
        <h2>Posso vender meu jogo no Indie Hub?</h2>
        <p>Sim! Desenvolvedores podem submeter seus jogos para avaliação. Envie um e-mail para <a href="mailto:desenvolvedores@indiehub.com">desenvolvedores@indiehub.com</a> com detalhes do seu projeto.</p>
    </div>
    <div class="faq-item">
        <h2>Como deixar um comentário?</h2>
        <p>Nosso sistema permite comentários em cada página de jogo. Basta preencher o formulário na seção de comentários e enviar.</p>
    </div>
</div>
<?php $this->end() ?>