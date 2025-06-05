<?php

namespace Source\Controllers\Admin;

use League\Plates\Engine;
use Source\Models\Submission;
use Source\Models\Game;

class AdminController
{
    /** @var Engine */
    private $view;

    public function __construct()
    {
       
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

      
        if (empty($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'admin') {
            header("Location: " . site() . "/login");
            exit;
        }

      
        $this->view = new Engine(__DIR__ . "/../../../themes/web");
    }

   
    public function dashboard(): void
    {
        $subModel     = new Submission();
        $pendingCount = count($subModel->getPending());

        $gameModel  = new Game();
        $totalGames = count($gameModel->getApproved());

        $userName = $_SESSION['user']['nome'] ?? "Administrador";

        echo $this->view->render("adm/dashboard", [
            'user'         => $userName,
            'pendingCount' => $pendingCount,
            'totalGames'   => $totalGames
        ]);
    }

    public function produtos(): void
    {
        $pending = (new Submission())->getPending();

        echo $this->view->render("adm/produtos", [
            'pending' => $pending
        ]);
    }

  
    public function aceitar(array $data): void
    {
        $id       = (int)$data['id'];
        $subModel = new Submission();
        $sub      = $subModel->find($id);

        if ($sub) {
            (new Game())->create([
                'titulo'     => $sub->titulo,
                'descricao'  => $sub->descricao,
                'preco'      => $sub->preco,
                'imagem'     => $sub->imagem,
                'criado_por' => $sub->usuario_id
            ]);
            $subModel->updateStatus($id, 'aprovado');
        }

        header("Location: " . site() . "/adm/produtos");
        exit;
    }

    
    public function rejeitar(array $data): void
    {
        $id = (int)$data['id'];
        (new Submission())->updateStatus($id, 'rejeitado');

        header("Location: " . site() . "/adm/produtos");
        exit;
    }

   
    public function formJogo(): void
    {
        echo $this->view->render("adm/cadastrar_jogo");
    }

    
    public function criarJogo(): void
    {
        $titulo    = $_POST['titulo']    ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $preco     = $_POST['preco']     ?? 0;
        $imagemDir = "";

        
        if (!empty($_FILES['imagem']['name']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../../assets/img/uploads/';
            $extension = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $newName   = uniqid('game_') . "." . $extension;
            move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadDir . $newName);
            $imagemDir = "assets/img/uploads/" . $newName;
        }

        (new Game())->create([
            'titulo'     => $titulo,
            'descricao'  => $descricao,
            'preco'      => (float)$preco,
            'imagem'     => $imagemDir,
            'criado_por' => $_SESSION['user']['id']
        ]);

        header("Location: " . site() . "/adm/jogos");
        exit;
    }

   
    public function jogos(): void
    {
        $games = (new Game())->getApproved();

        echo $this->view->render("adm/jogos", [
            'games' => $games
        ]);
    }

    
    public function editarJogo(array $data): void
    {
        $id   = (int)$data['id'];
        $game = (new Game())->find($id);

        echo $this->view->render("adm/editar-jogo", [
            'game' => $game
        ]);
    }

    public function atualizarJogo(): void
    {
        $id     = (int)($_POST['id'] ?? 0);
        $fields = [
            'titulo'    => $_POST['titulo']    ?? '',
            'descricao' => $_POST['descricao'] ?? '',
            'preco'     => $_POST['preco']     ?? 0,
            'imagem'    => $_POST['imagem']    ?? ''
        ];

        (new Game())->update($id, $fields);

        header("Location: " . site() . "/adm/jogos");
        exit;
    }

    public function deletarJogo(array $data): void
    {
        $id = (int)$data['id'];
        (new Game())->delete($id);

        header("Location: " . site() . "/adm/jogos");
        exit;
    }
}
