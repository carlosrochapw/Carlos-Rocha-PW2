<?php
namespace Source\Controllers\Api;

use Firebase\JWT\JWT;

class UsersApi
{
    private $secret;

    public function __construct()
    {
        
        $this->secret = getenv('JWT_SECRET') ?: 'chaveforte123456789!';
    }

    public function register(): void
    {
        header("Content-Type: application/json");
        $input = json_decode(file_get_contents("php://input"), true);

       
        if (empty($input['email']) || empty($input['senha'])) {
            http_response_code(400);
            echo json_encode(["error" => "Dados inválidos"]);
            return;
        }

       
        $userId = rand(1000, 9999);
       
        $tipo = ($input['email'] === "admin@indiehub.com") ? "admin" : "user";

        $payload = [
            "iat"  => time(),
            "exp"  => time() + 3600,
            "data" => [
                "id"   => $userId,
                "tipo" => $tipo
            ]
        ];
        $jwt = JWT::encode($payload, $this->secret, 'HS256');
        echo json_encode(["token" => $jwt]);
    }

    public function login(): void
    {
        header("Content-Type: application/json");
        $input = json_decode(file_get_contents("php://input"), true);

        if (empty($input['email']) || empty($input['senha'])) {
            http_response_code(400);
            echo json_encode(["error" => "Dados inválidos"]);
            return;
        }

       
        $userId = rand(1000, 9999);
        $tipo = ($input['email'] === "admin@indiehub.com") ? "admin" : "user";

        $payload = [
            "iat"  => time(),
            "exp"  => time() + 3600,
            "data" => [
                "id"   => $userId,
                "tipo" => $tipo
            ]
        ];
        $jwt = JWT::encode($payload, $this->secret, 'HS256');
        echo json_encode(["token" => $jwt]);
    }

    public function me(): void
    {
        header("Content-Type: application/json");
        $headers = getallheaders();
        if (empty($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(["error" => "Token não fornecido"]);
            return;
        }
        $token = trim(str_replace("Bearer", "", $headers['Authorization']));
        try {
            $decoded = JWT::decode($token, $this->secret, ['HS256']);
           
            echo json_encode($decoded->data);
        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(["error" => "Token inválido"]);
        }
    }
}
