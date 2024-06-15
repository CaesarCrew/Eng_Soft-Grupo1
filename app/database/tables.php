<?php

return [
    ["name"=>"secretaria" , "create" => "CREATE TABLE secretaria(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(30) NOT NULL,
        senha VARCHAR(61) NOT NULL
    )"],

    ["name"=>"usuario" , "create" => "CREATE TABLE usuario(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Nome VARCHAR(80) NOT NULL,
        senha VARCHAR(61) NOT NULL,
        email VARCHAR(100) NOT NULL,
        telefone VARCHAR(12) NOT NULL,
        cpf VARCHAR(12) NOT NULL,
        genero ENUM('M','F') NOT NULL,
        data_de_nascimento DATE NOT NULL,
        reset_token varchar(64) DEFAULT NULL,
        reset_expires datetime DEFAULT NULL
    )"],

    ["name"=>"horario_disponivel" , "create" => "CREATE TABLE horario_disponivel(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        dia_da_semana VARCHAR(30) NOT NULL,
        data DATE NOT NULL,
        hora TIME NOT NULL,
        disponivel TINYINT NOT NULL CHECK (disponivel  IN (0, 1))
    )"],

    ["name"=>"consulta" , "create" => "CREATE TABLE consulta(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_horario_disponivel INT(6) UNSIGNED NOT NULL,
        tipo_criador ENUM('usuario','secretaria') NOT NULL,
        id_criador_usuario INT(6) UNSIGNED,
        id_criador_secretaria INT(6) UNSIGNED,
        FOREIGN KEY (id_horario_disponivel) REFERENCES horario_disponivel(id) ON DELETE CASCADE,
        FOREIGN KEY (id_criador_usuario) REFERENCES usuario(id) ON DELETE CASCADE,
        FOREIGN KEY (id_criador_secretaria) REFERENCES secretaria(id) ON DELETE CASCADE
<<<<<<< HEAD
    )"] ,
=======
    )"],

>>>>>>> 2312263dadce6fe6cbbe09044fe5f061287737d9
    ["name"=>"endereco" , "create" => "CREATE TABLE endereco (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT(6) UNSIGNED NOT NULL,
        logradouro VARCHAR(255) NOT NULL,
        numero VARCHAR(10) NOT NULL,
        complemento VARCHAR(255),
        bairro VARCHAR(100) NOT NULL,
        cidade VARCHAR(100) NOT NULL,
        estado VARCHAR(2) NOT NULL,
        cep VARCHAR(8) NOT NULL
    )"]
];
