<?php
// conexao.php

class ConexaoBD {
    private $host = "localhost";
    private $usuario = "root"; // Usuário padrão do XAMPP
    private $senha = "";       // Senha padrão do XAMPP 
    private $banco = "tcc_adocao"; 
    private $conn;

    public function conectar() {
        // Cria a conexão usando MySQLi
        $this->conn = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);

        // Verifica a conexão
        if ($this->conn->connect_error) {
            die("Falha na conexão: " . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8mb4");

        return $this->conn;
    }
}
