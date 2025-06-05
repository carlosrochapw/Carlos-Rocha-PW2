<?php
namespace Source\Controllers\Api;

use Source\Core\Connect;
use PDO;

class GamesApi
{
    // GET → index()
    public function index(): void
    {
        $games = Connect::getInstance()
                 ->query("SELECT * FROM jogos ORDER BY criado_em DESC")
                 ->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($games);
    }

    // GET → show()
    public function show($data): void
    {
        $id   = (int)$data['id'];
        $stmt = Connect::getInstance()
                ->prepare("SELECT * FROM jogos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    }

    // POST → create()
    public function create(): void
    {
        $input = json_decode(file_get_contents("php://input"), true);
        $stmt = Connect::getInstance()->prepare(
            "INSERT INTO jogos (titulo, descricao, preco, imagem, criado_por)
             VALUES (:titulo, :descricao, :preco, :imagem, :criado_por)"
        );
        $stmt->execute([
          ':titulo'     => $input['titulo'],
          ':descricao'  => $input['descricao'],
          ':preco'      => $input['preco'],
          ':imagem'     => $input['imagem'],
          ':criado_por' => $input['criado_por']
        ]);
        echo json_encode(['id' => Connect::getInstance()->lastInsertId()]);
    }

    // PUT → update()
    public function update($data): void
    {
        $id    = (int)$data['id'];
        $input = json_decode(file_get_contents("php://input"), true);
        $stmt = Connect::getInstance()->prepare(
          "UPDATE jogos SET
             titulo    = :titulo,
             descricao = :descricao,
             preco     = :preco,
             imagem    = :imagem
           WHERE id = :id"
        );
        $stmt->execute([
          ':titulo'    => $input['titulo'],
          ':descricao' => $input['descricao'],
          ':preco'     => $input['preco'],
          ':imagem'    => $input['imagem'],
          ':id'        => $id
        ]);
        echo json_encode(['updated' => $stmt->rowCount()]);
    }

    // DELETE → delete()
    public function delete($data): void
    {
        $id   = (int)$data['id'];
        $stmt = Connect::getInstance()->prepare("DELETE FROM jogos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        echo json_encode(['deleted' => $stmt->rowCount()]);
    }
}
