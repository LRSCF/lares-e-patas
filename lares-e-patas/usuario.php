<?php
// C:\xampp\htdocs\lares-e-patas\Usuario.php

class Usuario {
    private $conexao;

   
    public function __construct($dados = null) {
        // Inicializa a conexão com o banco de dados
        $this->conectarBanco();
        
        
        if ($dados) {
            
        }
    }

    // Método privado para configurar a conexão 
    private function conectarBanco() {
        try {
            
            $host = 'localhost';
            $db = 'tcc_adocao'; 
            $user = 'root'; 
            $pass = ''; 
            
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            $this->conexao = new PDO($dsn, $user, $pass);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            // Em ambiente de produção, logar o erro em vez de exibi-lo
            die("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
        }
    }

    /**
     * Tenta logar o usuário com email e senha.
     * * @param string $email O e-mail (ou CPF) do usuário
     * @param string $senha A senha fornecida
     * @return array|false Os dados do usuário logado ou false se a autenticação falhar
     */
    public function logar($email, $senha) {
        
        // Consulta o usuário pelo e-mail
        $sql = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // 1. Verifica se o usuário foi encontrado
        if (!$usuario) {
            return false;
        }

        // 2. Verifica a senha
        
        if ($senha === $usuario['senha']) {
            // Sucesso no login. Retorna o array de dados do usuário.
            return $usuario;
        } 
        
        /*
        // PRÓXIMA ETAPA -  senhas criptografadas (RECOMENDADO):
        if (password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        */

        // Falha na senha
        return false;
    }
    
    
}

?>