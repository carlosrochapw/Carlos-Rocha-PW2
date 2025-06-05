<?php $this->layout('_theme', ['title' => 'Carrinho']); ?>
<?php $this->start('conteudo'); ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cart = $_SESSION['cart'] ?? [];
?>

<main>
  <section class="carrinho-container">
    <h1 class="titulo-pagina">Seu Carrinho</h1>

    <?php if (empty($cart)): ?>
      <p>Seu carrinho está vazio.</p>
    <?php else: ?>
      <div class="cart-conteudo">
     
        <div class="cart-items">
          <table>
            <thead>
              <tr>
                <th>Produto</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $subtotal = 0;
                foreach ($cart as $gameId => $qty):
                  $game = (new \Source\Models\Game())->find($gameId);
                  $price = (float)$game->preco;
                  $totalItem = $price * $qty;
                  $subtotal += $totalItem;
              ?>
                <tr>
                  <td><?= $this->e($game->titulo) ?></td>
                  <td>R$ <?= number_format($price, 2, ',', '.') ?></td>
                  <td><?= $qty ?></td>
                  <td>R$ <?= number_format($totalItem, 2, ',', '.') ?></td>
                  <td>
                    <a href="<?= site() ?>/carrinho?remove=<?= $gameId ?>"
                       onclick="return confirm('Deseja remover este item do carrinho?')">
                      Remover
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

   
        <aside class="cart-summary">
          <h2>Resumo da Compra</h2>
          <div class="informacoes">
            <div><span>Subtotal:</span> <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span></div>
            <div><span>Desconto:</span> <span>R$ 0,00</span></div>
          </div>
          <footer>
            <span>Total:</span> <span>R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
          </footer>
          
          <form id="checkout-form" method="get" action="<?= site() ?>/carrinho" style="margin:0">
            <input type="hidden" name="checkout" value="1">
            <button id="checkout-btn" class="checkout-btn" type="submit">FINALIZAR COMPRA</button>
          </form>
        </aside>
      </div>
    <?php endif; ?>

  </section>
</main>

<script>
 
  function indieToast(msg) {
    const toast = document.createElement('div');
    toast.innerText = msg;
    toast.style.position = 'fixed';
    toast.style.bottom = '32px';
    toast.style.right = '32px';
    toast.style.background = 'linear-gradient(90deg, #ffe066 0%, #ffb347 100%)';
    toast.style.color = '#2d1c0a';
    toast.style.padding = '1.1rem 2.2rem';
    toast.style.fontSize = '1.2rem';
    toast.style.borderRadius = '16px';
    toast.style.boxShadow = '0 4px 24px rgba(191,167,122,0.18)';
    toast.style.zIndex = '9999';
    toast.style.fontFamily = "'Press Start 2P', monospace";
    toast.style.fontWeight = 'bold';
    toast.style.letterSpacing = '1px';
    toast.style.opacity = '0';
    toast.style.transition = 'opacity 0.3s';
    document.body.appendChild(toast);
    setTimeout(() => { toast.style.opacity = '1'; }, 10);
    setTimeout(() => {
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 400);
    }, 2600);
  }

  document.getElementById('checkout-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    indieToast('Obrigado pela compra! Volte sempre.');
    setTimeout(() => this.submit(), 1200);
  });
</script>

<?php $this->end(); ?>
