<?php
namespace Source\Models;

use PDO;
use Source\Core\Connect; 

class Submission
{
    private $db;

    
    public function __construct()
    {
        $this->db = Connect::getInstance();
    }

   
    public function create(array $data): ?object
    {
        $sql = "INSERT INTO formulario_jogos (usuario_id, titulo, descricao, preco, imagem)
                VALUES (:usuario_id, :titulo, :descricao, :preco, :imagem)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":usuario_id", $data['usuario_id'], PDO::PARAM_INT);
        $stmt->bindValue(":titulo",     $data['titulo']);
        $stmt->bindValue(":descricao",  $data['descricao']);
        $stmt->bindValue(":preco",      $data['preco']);
        $stmt->bindValue(":imagem",     $data['imagem']);
        
        if ($stmt->execute()) {
            return $this->find((int)$this->db->lastInsertId());
        }
        
        return null;
    }

    
    public function getPending(): array
    {
        $sql = "SELECT f.id, f.titulo, f.descricao, f.preco, u.nome AS usuario 
                FROM formulario_jogos f 
                JOIN usuarios u ON u.id = f.usuario_id 
                WHERE f.status = 'pendente' 
                ORDER BY f.enviado_em DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

   
    public function updateStatus(int $id, string $status): bool
    {
        $sql = "UPDATE formulario_jogos SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":status", $status);
        $stmt->bindValue(":id",     $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    
    public function find(int $id): ?object
    {
        $sql = "SELECT * FROM formulario_jogos WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ) ?: null;
    }

  
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM formulario_jogos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
