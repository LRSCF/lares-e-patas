-- 1. CONFIGURAÇÃO INICIAL E CRIAÇÃO DO BANCO DE DADOS
CREATE SCHEMA IF NOT EXISTS tcc_adocao DEFAULT CHARACTER SET utf8mb4;

USE tcc_adocao;

-- 2. Tabela USUARIOS 
-- Será usada para Login e referenciar outras tabelas.
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    -- Usando ENUM para perfis fixos: facilita o controle de acesso no PHP
    tipo_usuario ENUM('administrador', 'voluntario', 'adotante') NOT NULL, 
    telefone VARCHAR(20)
) ENGINE=InnoDB;

-- Inserção de um Administrador Inicial
-- Senha: 'admin123' (criptografada com SHA256)
INSERT INTO usuarios (nome, email, senha, tipo_usuario) 
VALUES ('Administrador Master', 'admin@adocao.com', SHA2('admin123', 256), 'administrador');


-- 3. Tabela ANIMAIS
CREATE TABLE IF NOT EXISTS animais (
    id_animal INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    especie VARCHAR(30) NOT NULL, -- Ex: Gato, Cachorro
    sexo ENUM('Macho', 'Fêmea') NOT NULL,
    idade VARCHAR(20),
    castrado ENUM('Sim', 'Não') NOT NULL,
    porte ENUM('Pequeno', 'Médio', 'Grande'),
    descricao TEXT,
    cidade VARCHAR(50),
    ong VARCHAR(100),
    foto VARCHAR(255) -- Caminho ou URL da imagem
) ENGINE=InnoDB;

-- 4. Tabela DOAÇÕES (Chave Estrangeira para usuarios)
CREATE TABLE IF NOT EXISTS doacoes (
    id_doacao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT, -- Pode ser NULL se for doação anônima, se não, deve ser NOT NULL
    tipo_doacao VARCHAR(50),
    valor DECIMAL(10,2),
    descricao TEXT,
    data_doacao DATETIME,
    
    FOREIGN KEY (id_usuario) 
        REFERENCES usuarios(id_usuario)
        ON DELETE SET NULL -- Se o usuário for deletado, a doação permanece registrada, mas o id_usuario fica NULL
) ENGINE=InnoDB;



-- 5. Tabela VOLUNTARIOS (Chave Estrangeira para usuarios)
CREATE TABLE IF NOT EXISTS voluntarios (
    id_voluntario INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    disponibilidade VARCHAR(255),
    tipo_atividade VARCHAR(50),
    observacoes TEXT,
    
    FOREIGN KEY (id_usuario) 
        REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE -- Se o usuário for deletado, o registro de voluntário é deletado
) ENGINE=InnoDB;



-- 6. Tabela EVENTOS 
CREATE TABLE IF NOT EXISTS eventos (
    id_evento INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150),
    descricao TEXT,
    data_inicio DATETIME,
    data_fim DATETIME,
    local VARCHAR(100),
    responsavel VARCHAR(100)
    
    
    
) ENGINE=InnoDB;

USE tcc_adocao;

-- VARIÁVEL PADRÃO PARA ANIMAIS SEM FOTO ESPECÍFICA
SET @DEFAULT_PHOTO = 'srd.png'; 

-- 2. Coluna 'observacao' substituída por 'descricao' (o nome correto na tabela).
-- COLUNAS INSERIDAS: nome, especie, sexo, idade, castrado, porte, cidade, ong, foto, descricao

-- ***** CANINOS MACHOS *****

INSERT INTO animais (nome, especie, sexo, idade, castrado, porte, cidade, ong, foto, descricao) VALUES
('Corintiano', 'Cachorro', 'Macho', 'Idoso', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Cego de 1 olho. Medroso.'),
('Bidu', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'P/M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Medroso.'),
('Marrento', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M/G', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Medroso.'),
('Amarelão', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M/G', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Manso / Dócil.'),
('Adele', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Medrosa.'),
('Preta', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Mansa / Desconfiada.'),
('Aramis', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Filhote - Muito dócil.'),
('Porthos', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Filhote - Muito dócil.'),
('MacGyver', 'Cachorro', 'Macho', 'Idoso', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Idoso.'),
('Melissa', 'Cachorro', 'Macho', 'Idosa', 'Não', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Idosa.'),
('Vanilla', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Idosa.'),
('Billy', 'Cachorro', 'Macho', 'Filhote', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', 'Billy.png', 'Filhote - Muito dócil.'),
('Snoopy', 'Cachorro', 'Macho', 'Filhote', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', 'Snoopy.png', 'Filhote - Muito dócil.'),
('Dunga', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Indefinida.'),
('Diesel', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Indefinida.'),
('Alan Delon', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Indefinida.'),
('Dudu', 'Cachorro', 'Macho', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Indefinida.'),
('Hulk', 'Cachorro', 'Macho', 'Filhote', 'Sim', 'G', 'Pinhalzinho - SP', 'Lares & Patas', 'Hulk.png', 'Dócil.');


-- ***** CANINOS FÊMEAS *****

INSERT INTO animais (nome, especie, sexo, idade, castrado, porte, cidade, ong, foto, descricao) VALUES
('Maya', 'Cachorro', 'Fêmea', 'Idosa', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Idosa. Cega de 1 olho.'),
('Belinha', 'Cachorro', 'Fêmea', 'Idosa', 'Não', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Idosa. Mansas / Desconfiada.'),
('Luzia', 'Cachorro', 'Fêmea', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Filhote - Muito dócil.'),
('Rebeca', 'Cachorro', 'Fêmea', 'Filhote', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', 'Rebeca.png', 'Filhote - Muito dócil. Adoção conjunta Raissa'),
('Sasha', 'Cachorro', 'Fêmea', 'Filhote', 'Não', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Filhote - Muito dócil.'),
('Preciosa', 'Cachorro', 'Fêmea', 'Filhote', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Filhote - Muito dócil.'),
('Loba (Dandara)', 'Cachorro', 'Fêmea', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Indefinida.'),
('Dalila', 'Cachorro', 'Fêmea', 'Indefinida', 'Sim', 'P/M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Mansa.'),
('Mel', 'Cachorro', 'Fêmea', 'Indefinida', 'Não', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Indefinida.'),
('Princesa', 'Cachorro', 'Fêmea', 'Indefinida', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', @DEFAULT_PHOTO, 'Dócil.'),
('Xuxa', 'Cachorro', 'Fêmea', 'Indefinida', 'Sim', 'P/M', 'Pinhalzinho - SP', 'Lares & Patas', 'Xuxa.png', 'Dócil.'),
('Lilica', 'Cachorro', 'Fêmea', 'Indefinida', 'Sim', 'P/M', 'Pinhalzinho - SP', 'Lares & Patas', 'Lilica.png', 'Dócil.'),
('Estrela', 'Cachorro', 'Fêmea', 'Indefinida', 'Sim', 'P/M', 'Pinhalzinho - SP', 'Lares & Patas', 'Estrela.png', 'Dócil.');
('Raissa', 'Cachorro', 'Fêmea', 'Filhote', 'Sim', 'M', 'Pinhalzinho - SP', 'Lares & Patas', 'Raissa.png', 'Filhote - Muito dócil.Adoção conjunta Rebeca'),
-- Altera a coluna 'porte' na tabela 'animais' para aceitar até 5 caracteres,
-- acomodando valores como 'P/M' e 'M/G'.
ALTER TABLE animais
MODIFY porte VARCHAR(5) NOT NULL;

-- CUIDADO: Este comando apaga a tabela que já existe.
DROP TABLE IF EXISTS `usuario`;

-- Criação da Tabela 'usuario'
CREATE TABLE `usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(20) DEFAULT NULL,
  `tipo_usuario` ENUM('administrador', 'adotante', 'voluntario') NOT NULL,
  `data_cadastro` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserindo um usuário ADMINISTRADOR para testes
-- Email: admin@adocao.com
-- Senha: 123456
INSERT INTO `usuario` 
    (`nome`, `cpf`, `email`, `senha`, `telefone`, `tipo_usuario`) 
VALUES 
    ('Administrador Master', '99999999999', 'admin@adocao.com', '123456', '(11) 99999-9999', 'administrador');

-- Inserindo um usuário ADOTANTE para testes
-- Email: adotante@teste.com
-- Senha: 123456
INSERT INTO `usuario` 
    (`nome`, `cpf`, `email`, `senha`, `telefone`, `tipo_usuario`) 
VALUES 
    ('Ana Adotadora', '11111111111', 'adotante@teste.com', '123456', '(11) 11111-1111', 'adotante');

-- Inserindo um usuário VOLUNTÁRIO para testes
-- Email: voluntario@teste.com
-- Senha: 123456
INSERT INTO `usuario` 
    (`nome`, `cpf`, `email`, `senha`, `telefone`, `tipo_usuario`) 
VALUES 
    ('Valter Voluntário', '22222222222', 'voluntario@teste.com', '123456', '(11) 22222-2222', 'voluntario');