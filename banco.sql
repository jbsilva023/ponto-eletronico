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

-------------------------------------------------------------------------------------------------------------------
-- PROCEDURE VERIFICAR VALORES PARA SUBITRAIR
-------------------------------------------------------------------------------------------------------------------
ALTER TABLE registros ADD CONSTRAINT fk_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE;

DELIMITER $$

DROP PROCEDURE IF EXISTS `verificar_valor`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verificar_valor`(
    v_id_registro INT,
    v_entrada CHARACTER(8),
    v_saida CHARACTER(8)
)
BEGIN
    DECLARE TimeResult TIME;
    DECLARE Result TIME;
    DECLARE parts CHARACTER;

    SELECT TIMEDIFF(v_saida, v_entrada) INTO TimeResult
    FROM registros
    WHERE id = v_id_registro;

    SET parts = SUBSTRING_INDEX(SUBSTRING_INDEX(TimeResult, ':', 1), ' ', -1);

    IF (parts < 0 || (LEFT(parts, 1) = '-')) THEN
        SELECT TIMEDIFF(v_entrada, v_saida) INTO TimeResult
        FROM registros
        WHERE id = v_id_registro;
    END IF;

    SET Result = TimeResult;
    SELECT Result;
END $$

DELIMITER ;