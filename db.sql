
CREATE TABLE usuarios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  senha VARCHAR(255) NOT NULL,
  tipo ENUM('user','admin') NOT NULL DEFAULT 'user',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE jogos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(150) NOT NULL,
  descricao TEXT NOT NULL,
  preco DECIMAL(8,2) NOT NULL,
  imagem VARCHAR(255),
  criado_por INT,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (criado_por) REFERENCES usuarios(id)
);


CREATE TABLE formulario_jogos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  usuario_id INT NOT NULL,
  titulo VARCHAR(150) NOT NULL,
  descricao TEXT NOT NULL,
  preco DECIMAL(8,2) NOT NULL,
  imagem VARCHAR(255),
  enviado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status ENUM('pendente','aprovado','rejeitado') NOT NULL DEFAULT 'pendente',
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);


CREATE TABLE carrinho (
  id INT PRIMARY KEY AUTO_INCREMENT,
  usuario_id INT NOT NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status ENUM('aberto','finalizado') NOT NULL DEFAULT 'aberto',
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);


CREATE TABLE itens_carrinho (
  id INT PRIMARY KEY AUTO_INCREMENT,
  carrinho_id INT NOT NULL,
  jogo_id INT NOT NULL,
  quantidade INT NOT NULL DEFAULT 1,
  preco_unitario DECIMAL(8,2) NOT NULL,
  FOREIGN KEY (carrinho_id) REFERENCES carrinho(id),
  FOREIGN KEY (jogo_id) REFERENCES jogos(id)
);


CREATE TABLE compras (
  id INT PRIMARY KEY AUTO_INCREMENT,
  usuario_id INT NOT NULL,
  total DECIMAL(10,2) NOT NULL,
  comprado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);


CREATE TABLE itens_compra (
  id INT PRIMARY KEY AUTO_INCREMENT,
  compra_id INT NOT NULL,
  jogo_id INT NOT NULL,
  quantidade INT NOT NULL DEFAULT 1,
  preco_unitario DECIMAL(8,2) NOT NULL,
  FOREIGN KEY (compra_id) REFERENCES compras(id),
  FOREIGN KEY (jogo_id) REFERENCES jogos(id)
);
CREATE TABLE comentarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  jogo_id INT NOT NULL,
  autor VARCHAR(100) NOT NULL,
  mensagem TEXT NOT NULL,
  avaliacao TINYINT NOT NULL CHECK (avaliacao BETWEEN 1 AND 5),
  criado_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (jogo_id) REFERENCES jogos(id) ON DELETE CASCADE
);