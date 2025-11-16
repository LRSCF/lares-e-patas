<?php
require_once 'ConexaoBD.php';

class Animal {
    private $conn;

    // Construtor que inicializa a conexão
    public function __construct() {
        $conexao = new ConexaoBD();
        $this->conn = $conexao->conectar();
    }

    /**
     * Lista animais com base em filtros dinâmicos.
     * @param array $filtros Array associativo com os filtros (especie, sexo, porte, etc.).
     * @return mysqli_result|false O resultado da query ou false em caso de erro.
     */
    public function listarAnimaisComFiltro($filtros = []) {
        
        $sql = "SELECT * FROM animais WHERE 1=1"; // 1=1 permite adicionar WHEREs dinamicamente
        $params = [];
        $tipos = '';

        // Monta a query e os parâmetros dinamicamente
        foreach ($filtros as $chave => $valor) {
            // Ignora valores vazios para não aplicar o filtro
            if (!empty($valor)) {
                
                // Usamos LIKE para permitir busca parcial ou 'Todas'
                $sql .= " AND " . $chave . " LIKE ?";
                $params[] = "%" . $valor . "%";
                $tipos .= 's'; // 's' para string, pois todos os filtros são strings
            }
        }
        
        //  ORDER BY padrão para ordenar por nome
        $sql .= " ORDER BY nome ASC";

        try {
            // Prepara a query
            $stmt = $this->conn->prepare($sql);
            
            if ($stmt === false) {
                error_log("Erro na preparação da query: " . $this->conn->error);
                return false;
            }

            // Faz o bind dos parâmetros dinamicamente se houver filtros
            if (!empty($params)) {
                 // Usa o call_user_func_array para chamar bind_param com array de referências
                $bind_params = array($tipos);
                foreach ($params as $key => $value) {
                    $bind_params[] = &$params[$key]; // Passa a referência
                }
                call_user_func_array(array($stmt, 'bind_param'), $bind_params);
            }

            // Executa a query
            $stmt->execute();
            
            // Retorna o resultado
            return $stmt->get_result();

        } catch (Exception $e) {
            error_log("Erro ao listar animais: " . $e->getMessage());
            return false;
        }
    }
    
    // Opcional: Fechar a conexão quando o objeto for destruído
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>