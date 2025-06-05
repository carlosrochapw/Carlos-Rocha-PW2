<?php
namespace Source\Models;

use PDO;

class Order
{
    private $db;

    public function __construct()
    {
        $this->db = Connect::getInstance();
    }

    
    public function checkout(int $cartId, int $userId): bool
    {
      
        $this->db->beginTransaction();

        try {
           
            $sql = "SELECT SUM(quantidade * preco_unitario) as total
                    FROM itens_carrinho WHERE carrinho_id = :cid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":cid", $cartId, PDO::PARAM_INT);
            $stmt->execute();
            $total = (float)($stmt->fetch()->total ?? 0);

          
            $sql = "INSERT INTO compras (usuario_id, total) VALUES (:uid, :total)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":uid",   $userId, PDO::PARAM_INT);
            $stmt->bindValue(":total", $total);
            $stmt->execute();
            $orderId = (int)$this->db->lastInsertId();

            
            $items = (new Cart())->getItems($cartId);
            $sql = "INSERT INTO itens_compra (compra_id, jogo_id, quantidade, preco_unitario)
                    VALUES (:oid, :gid, :qty, :price)";
            $stmt = $this->db->prepare($sql);
            foreach ($items as $item) {
                $stmt->bindValue(":oid",   $orderId, PDO::PARAM_INT);
                $stmt->bindValue(":gid",   $item->jogo_id, PDO::PARAM_INT);
                $stmt->bindValue(":qty",   $item->quantidade, PDO::PARAM_INT);
                $stmt->bindValue(":price", $item->preco_unitario);
                $stmt->execute();
            }

            
            $sql = "UPDATE carrinho SET status = 'finalizado' WHERE id = :cid";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":cid", $cartId, PDO::PARAM_INT);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
