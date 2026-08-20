CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome_user VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL
);

CREATE TABLE pratos (
    id INT PRIMARY KEY AUTO_INCREMENT ,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(100) NOT NULL,

    usuario_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);