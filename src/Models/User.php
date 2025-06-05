<?php
namespace Source\Models;

use Source\Core\Connect;
use \PDO;
use \PDOException;

class User
{
    public $id;
    public $nome;
    public $email;
    public $senha;
    public $tipo;

   
    public function verify(string $email, string $password)
    {
        $pdo  = Connect::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if ($user && password_verify($password, $user->senha)) {
            return $user;
        }
        return false;
    }

    public function create(array $data)
    {
        $pdo = Connect::getInstance();

        
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);

        
        try {
            $success = $stmt->execute([
                ':nome'  => $data['nome'],  
                ':email' => $data['email'], 
                ':senha' => password_hash($data['senha'], PASSWORD_DEFAULT)
            ]);

            if ($success) {
                
                $this->id    = $pdo->lastInsertId();
                $this->nome  = $data['nome'];
                $this->email = $data['email'];
                $this->tipo  = 'user';
                return $this;
            }

            return false;
        } catch (PDOException $e) {
            
            if ($e->getCode() === '23000') {
                return false;
            }
            throw $e;
        }
    }
}
