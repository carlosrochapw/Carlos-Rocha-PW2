<?php

namespace Source\Models;

use Source\Core\Connect;
use PDO;

class Game
{
    /** @var PDO */
    private $db;

    public function __construct()
    {
        // Pega instância de PDO via Connect
        $this->db = Connect::getInstance();
    }

   
    public function getApproved(): array
    {
        $sql = "SELECT * FROM jogos ORDER BY criado_em DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

 
    public function find(int $id): ?object
    {
        $sql = "SELECT * FROM jogos WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $game = $stmt->fetch(PDO::FETCH_OBJ);
        return $game !== false ? $game : null;
    }

    
    public function create(array $data): ?object
    {
        $sql = "INSERT INTO jogos (titulo, descricao, preco, imagem, criado_por)
                VALUES (:titulo, :descricao, :preco, :imagem, :criado_por)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":titulo",     $data['titulo']);
        $stmt->bindValue(":descricao",  $data['descricao']);
        $stmt->bindValue(":preco",      $data['preco']);
        $stmt->bindValue(":imagem",     $data['imagem']);
        $stmt->bindValue(":criado_por", $data['criado_por'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $lastId = (int)$this->db->lastInsertId();
            return $this->find($lastId);
        }

        return null;
    }

   
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE jogos
                SET titulo    = :titulo,
                    descricao = :descricao,
                    preco     = :preco,
                    imagem    = :imagem
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(":titulo",    $data['titulo']);
        $stmt->bindValue(":descricao", $data['descricao']);
        $stmt->bindValue(":preco",     $data['preco']);
        $stmt->bindValue(":imagem",    $data['imagem']);
        $stmt->bindValue(":id",        $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM jogos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
