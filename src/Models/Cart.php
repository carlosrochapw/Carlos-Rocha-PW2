<?php
namespace Source\Models;

use PDO;

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = Connect::getInstance();
    }


    public function getCart(int $userId): object
    {
        $sql = "SELECT * FROM carrinho WHERE usuario_id = :uid AND status = 'aberto' LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":uid", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $cart = $stmt->fetch();
        if ($cart) {
            return $cart;
        }

        $sql = "INSERT INTO carrinho (usuario_id) VALUES (:uid)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":uid", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $id = (int)$this->db->lastInsertId();

        return (object)[
            "id" => $id,
            "usuario_id" => $userId,
            "status" => "aberto"
        ];
    }

   
    public function addItem(int $cartId, int $gameId, int $qty, float $price): bool
    {
        $sql = "SELECT * FROM itens_carrinho WHERE carrinho_id = :cid AND jogo_id = :gid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":cid", $cartId, PDO::PARAM_INT);
        $stmt->bindValue(":gid", $gameId, PDO::PARAM_INT);
        $stmt->execute();
        if ($item = $stmt->fetch()) {
            $newQty = $item->quantidade + $qty;
            $sql = "UPDATE itens_carrinho SET quantidade = :q WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":q",  $newQty, PDO::PARAM_INT);
            $stmt->bindValue(":id", $item->id, PDO::PARAM_INT);
            return $stmt->execute();
        }

        $sql = "INSERT INTO itens_carrinho (carrinho_id, jogo_id, quantidade, preco_unitario)
                VALUES (:cid, :gid, :qty, :price)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":cid",   $cartId, PDO::PARAM_INT);
        $stmt->bindValue(":gid",   $gameId, PDO::PARAM_INT);
        $stmt->bindValue(":qty",   $qty,    PDO::PARAM_INT);
        $stmt->bindValue(":price", $price);
        return $stmt->execute();
    }

    public function getItems(int $cartId): array
    {
        $sql = "SELECT ic.*, j.titulo, j.imagem, j.preco
                FROM itens_carrinho ic
                JOIN jogos j ON j.id = ic.jogo_id
                WHERE ic.carrinho_id = :cid";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":cid", $cartId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function removeItem(int $itemId): bool
    {
        $sql = "DELETE FROM itens_carrinho WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $itemId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    
    public function checkout(int $cartId, int $userId): bool
    {
        $itens = $this->getItems($cartId);
        if (empty($itens)) {
            return false;
        }

        $total = array_reduce($itens, function ($sum, $item) {
            return $sum + ($item->preco_unitario * $item->quantidade);
        }, 0);

        $sql = "INSERT INTO compras (usuario_id, total) VALUES (:uid, :total)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":uid", $userId, PDO::PARAM_INT);
        $stmt->bindValue(":total", $total);
        if (!$stmt->execute()) {
            return false;
        }

        $compraId = (int)$this->db->lastInsertId();

        foreach ($itens as $item) {
            $sql = "INSERT INTO itens_compra (compra_id, jogo_id, quantidade, preco_unitario)
                    VALUES (:cid, :jid, :qty, :price)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":cid",   $compraId, PDO::PARAM_INT);
            $stmt->bindValue(":jid",   $item->jogo_id, PDO::PARAM_INT);
            $stmt->bindValue(":qty",   $item->quantidade, PDO::PARAM_INT);
            $stmt->bindValue(":price", $item->preco_unitario);
            $stmt->execute();
        }

        $sql = "UPDATE carrinho SET status = 'finalizado' WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $cartId, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
