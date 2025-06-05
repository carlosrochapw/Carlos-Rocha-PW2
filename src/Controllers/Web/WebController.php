<?php
namespace Source\Controllers\Web;

use League\Plates\Engine;
use Source\Models\Game;


class WebController
{
    /** @var Engine */
    private Engine $view;

    public function __construct()
    {
        // Ajuste o caminho para onde estão seus templates públicos
       $this->view = new Engine(__DIR__ . '/../../../themes/web');
        // Disponibiliza a URL base em todas as views
        $this->view->addData(['site' => site()]);
        // Torna a função site() disponível nos templates Plates
        $this->view->registerFunction('site', function() {
            return site();
        });
    }

  public function home(): void
{
    // Obtém todos os jogos aprovados (ordenados por data de criação)
    $gameModel = new Game();
    $games = $gameModel->getApproved();
    echo $this->view->render('home', ['games' => $games]);
}

public function jogo(array $data): void
{
    // Busca o jogo pelo ID recebido na rota (/jogo/{id})
    $gameId = (int)$data['id'];
    $gameModel = new Game();
    $game = $gameModel->find($gameId);
    echo $this->view->render('jogo', ['game' => $game]);
}


    public function registro(): void
    {
        echo $this->view->render('registro');
    }

    public function login(): void
    {
        echo "<!-- CHEGUEI EM WebController::login() -->";
        echo $this->view->render('login');
    }

    public function sobre(): void
    {
        echo $this->view->render('sobre');
    }

    public function faq(): void
    {
        echo $this->view->render('faq');
    }

    public function carrinho(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
   
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

  
    if (!empty($_GET['add'])) {
        $gameId = (int)$_GET['add'];
        
        if (isset($_SESSION['cart'][$gameId])) {
            $_SESSION['cart'][$gameId]++;
        } else {
            $_SESSION['cart'][$gameId] = 1;
        }
        
        header("Location: " . site() . "/carrinho");
        exit;
    }

    
    if (!empty($_GET['remove'])) {
        $gameId = (int)$_GET['remove'];
        unset($_SESSION['cart'][$gameId]);
        header("Location: " . site() . "/carrinho");
        exit;
    }

   
    if (!empty($_GET['checkout'])) {
       
        $_SESSION['cart'] = [];
       
        header("Location: " . site() . "/");
        exit;
    }

   
    echo $this->view->render('carrinho');
}


    public function error(array $data): void
    {
        echo $this->view->render('error', ['error' => $data['errcode']]);
    }

    public function logout(): void
    {
        session_destroy();
        header('Location: ' . site() . '/login');
        exit;
    }
public function registroPost(): void
{
    
    if ($usuario) {
        
        $_SESSION['user'] = [
            'id'   => $usuario->id,
            'nome' => $usuario->nome,
            'tipo' => $usuario->tipo
        ];
        header("Location: " . site() . "/app");
        exit;
    }
   
    header("Location: " . site() . "/registro?erro=sim");
    exit;
}


public function loginPost(): void
{
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    $modelUser = new \Source\Models\User();
    $usuario = $modelUser->verify($email, $senha); 

    if ($usuario) {
      
        $_SESSION['user'] = [
            'id'   => $usuario->id,
            'nome' => $usuario->nome,
            'tipo' => $usuario->tipo
        ];
      
        if ($usuario->tipo === 'admin') {
            header("Location: " . site() . "/adm");
        } else {
            header("Location: " . site() . "/app");
        }
        exit;
    } else {
       
        header("Location: " . site() . "/login?erro=sim");
        exit;
    }
}



}
