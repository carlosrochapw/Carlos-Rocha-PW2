<?php
namespace Source\Models;

use Source\Core\Connect;
use PDO;

class Comment
{
    private $db;

    public function __construct()
    {
        $this->db = Connect::getInstance();
    }

 
    public function create(array $data): bool
    {
        $sql = "INSERT INTO comentarios (jogo_id, autor, mensagem, avaliacao) VALUES (:jogo_id, :autor, :mensagem, :avaliacao)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jogo_id',   $data['jogo_id'], PDO::PARAM_INT);
        $stmt->bindValue(':autor',     $data['autor']);
        $stmt->bindValue(':mensagem',  $data['mensagem']);
        $stmt->bindValue(':avaliacao', $data['avaliacao'], PDO::PARAM_INT);
        return $stmt->execute();
    }

   
    public function getByGame(int $jogoId): array
    {
        $sql = "SELECT * FROM comentarios WHERE jogo_id = :jogo_id ORDER BY criado_em DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':jogo_id', $jogoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
