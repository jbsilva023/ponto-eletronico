DROP DATABASE controle;

CREATE DATABASE controle;

use controle;

DROP TABLE usuarios;

CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    cpf CHAR(11) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);

DROP TABLE registros;

CREATE TABLE registros (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    data date NOT NULL,
    entrada time NOT NULL,
    saida_intervalo time,
    entrada_intervalo time,
    saida time,
    usuario_id INT UNSIGNED NOT NULL
);

ALTER TABLE registros ADD CONSTRAINT fk_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE;