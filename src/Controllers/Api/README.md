# IndieHub API – Documentação

## Descrição Geral
Esta API RESTful permite o gerenciamento de jogos (products) e usuários para a plataforma IndieHub. Todas as operações utilizam JSON para envio e recebimento de dados. Algumas rotas exigem autenticação via JWT (JSON Web Token).

---

## Rotas Disponíveis

### Autenticação

#### POST /api/users/login
Autentica um usuário e retorna um token JWT.
- **Body (JSON):**
  ```json
  { "email": "user@exemplo.com", "senha": "123456" }
  ```
- **Resposta (200):**
  ```json
  { "token": "jwt_token_aqui" }
  ```
- **Códigos HTTP:** 200 (OK), 400 (dados inválidos)

#### POST /api/users/register
Registra um novo usuário e retorna um token JWT.
- **Body (JSON):**
  ```json
  { "email": "user@exemplo.com", "senha": "123456" }
  ```
- **Resposta (200):**
  ```json
  { "token": "jwt_token_aqui" }
  ```
- **Códigos HTTP:** 200 (OK), 400 (dados inválidos)

#### GET /api/users/me
Retorna os dados do usuário autenticado.
- **Header:**
  ```
  Authorization: Bearer <token>
  ```
- **Resposta (200):**
  ```json
  { "id": 1234, "tipo": "user" }
  ```
- **Códigos HTTP:** 200 (OK), 401 (token ausente ou inválido)

---

### Jogos (Products)

#### GET /api/games
Lista todos os jogos cadastrados.
- **Resposta (200):**
  ```json
  [
    { "id": 1, "titulo": "Jogo A", "descricao": "...", "preco": 19.99, "imagem": "...", "criado_por": 1 },
    { "id": 2, "titulo": "Jogo B", "descricao": "...", "preco": 29.99, "imagem": "...", "criado_por": 2 }
  ]
  ```
- **Códigos HTTP:** 200 (OK)

#### GET /api/games/{id}
Retorna detalhes de um jogo específico.
- **Resposta (200):**
  ```json
  { "id": 1, "titulo": "Jogo A", "descricao": "...", "preco": 19.99, "imagem": "...", "criado_por": 1 }
  ```
- **Códigos HTTP:** 200 (OK), 404 (não encontrado)

#### POST /api/games
Cria um novo jogo (requer autenticação).
- **Header:**
  ```
  Authorization: Bearer <token>
  ```
- **Body (JSON):**
  ```json
  { "titulo": "Novo Jogo", "descricao": "...", "preco": 15.50, "imagem": "url.jpg", "criado_por": 1 }
  ```
- **Resposta (200):**
  ```json
  { "id": 3 }
  ```
- **Códigos HTTP:** 200 (OK), 400 (dados inválidos), 401 (não autorizado)

#### PUT /api/games/{id}
Atualiza um jogo existente (requer autenticação).
- **Header:**
  ```
  Authorization: Bearer <token>
  ```
- **Body (JSON):**
  ```json
  { "titulo": "Jogo Atualizado", "descricao": "...", "preco": 17.00, "imagem": "nova.jpg" }
  ```
- **Resposta (200):**
  ```json
  { "updated": 1 }
  ```
- **Códigos HTTP:** 200 (OK), 400 (dados inválidos), 401 (não autorizado), 404 (não encontrado)

#### DELETE /api/games/{id}
Remove um jogo (requer autenticação).
- **Header:**
  ```
  Authorization: Bearer <token>
  ```
- **Resposta (200):**
  ```json
  { "deleted": 1 }
  ```
- **Códigos HTTP:** 200 (OK), 401 (não autorizado), 404 (não encontrado)

---

## Códigos de Status HTTP
- **200 OK:** Sucesso
- **201 Created:** Recurso criado
- **400 Bad Request:** Dados inválidos
- **401 Unauthorized:** Token ausente ou inválido
- **404 Not Found:** Não encontrado

---

## Autenticação JWT
1. Faça login ou registro para obter um token JWT.
2. Envie o token no header Authorization em todas as rotas protegidas:
   ```
   Authorization: Bearer seu_token_jwt
   ```
3. Sem o token, a API retorna 401 Unauthorized.

---

## Exemplos de Teste com cURL

```bash
# Login
curl -X POST http://localhost/api/users/login -H "Content-Type: application/json" -d '{"email":"user@exemplo.com","senha":"123456"}'

# Listar jogos
curl -X GET http://localhost/api/games

# Criar jogo (autenticado)
curl -X POST http://localhost/api/games -H "Authorization: Bearer <TOKEN>" -H "Content-Type: application/json" -d '{"titulo":"Novo Jogo","descricao":"Desc","preco":10.0,"imagem":"img.jpg","criado_por":1}'
```

---

## Observações
- Os exemplos acima usam URLs e campos genéricos. Lembre-se de ajustar conforme o ambiente em que a API estiver rodando (por exemplo, trocar 'localhost' pelo domínio do servidor em produção).
- Em caso de dúvidas ou problemas, consulte o código-fonte do projeto ou entre em contato diretamente comigo, responsável pelo desenvolvimento da API.
