<?php
namespace Source\Controllers\App;

use League\Plates\Engine;

class AppController
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../../themes/web");
      
    }

    public function dashboard(): void
    {
       
        $subs = $_SESSION['submissions'] ?? [];
       
        $userName = $_SESSION['user']['nome'] ?? "Usuário";
        echo $this->view->render("app/dashboard", [
            'subs' => $subs,
            'user' => $userName
        ]);
    }

    public function addToCart(array $data): void
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            header("Location: " . site() . "/login");
            exit;
        }

        $cartModel = new \Source\Models\Cart();
        $cart = $cartModel->getCart($userId);

        $jogoId = (int)$data['id'];
        $preco  = (float)$data['preco']; // ou busque do banco
        $cartModel->addItem($cart->id, $jogoId, 1, $preco);

        header("Location: " . site() . "/carrinho");
    }

    public function showForm(): void
    {

        echo $this->view->render("app/submit_form");
    }

    public function submit(): void
    {
      
        $titulo    = $_POST['titulo']    ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $preco     = $_POST['preco']     ?? 0;
        $imagem    = '';

        $usuarioId = $_SESSION['user']['id'] ?? null;
        if (!$usuarioId) {
            header("Location: " . site() . "/login");
            exit;
        }

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . "." . $ext;
            $uploadDir = __DIR__ . "/../../../assets/img/uploads/";

          
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destPath)) {
                // Caminho relativo para armazenar no banco
                $imagem = "assets/img/uploads/" . $fileName;
            }
        }

       
        $subModel = new \Source\Models\Submission();
        $submission = $subModel->create([
            'usuario_id' => $usuarioId,
            'titulo'     => $titulo,
            'descricao'  => $descricao,
            'preco'      => $preco,
            'imagem'     => $imagem
        ]);

       
        header("Location: " . site() . "/app");
        exit;
    }
}
