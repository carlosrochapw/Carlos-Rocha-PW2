<?php $this->layout('_theme', ['title' => 'Sobre e Contato']) ?>

<?php $this->start('conteudo') ?>
<div class="sobre-container">
    

    <h1>Sobre o Indie Hub</h1>
    <p>O Indie Hub é uma plataforma micro SaaS dedicada à divulgação, comercialização e gerenciamento de jogos independentes. Além de permitir que desenvolvedores publiquem seus próprios jogos, a plataforma também oferece uma loja virtual com títulos indie já existentes no mercado.</p>

    <h1>Área de Atuação</h1>
    <p>A área de atuação é focada no setor de serviços digitais e comércio eletrônico, resolvendo desafios como baixa visibilidade e distribuição fragmentada enfrentados por desenvolvedores indie.</p>

    <h1>Público-Alvo</h1>
    <p>Desenvolvedores: Criadores independentes que querem publicar e vender jogos.</p>
    <p>Jogadores: Pessoas interessadas em jogos alternativos e únicos.</p>
    <p>Administradores: Usuários internos que gerenciam a plataforma.</p>


    <h1>Valores</h1>
       <p>Inovação: Foco em criatividade e ousadia nos jogos.</p>
       <p>Comunidade: União entre criadores e público.</p>
       <p>Acessibilidade: Facilidade para todos usarem a plataforma.</p>


    <?php include __DIR__ . '/contato.php'; ?>

</div>
<?php $this->end() ?>
