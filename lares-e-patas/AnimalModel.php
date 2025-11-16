<?php

// Inclui o arquivo de conexão para poder utilizá-lo
require_once 'ConexaoBD.php';

/**
 * Classe responsável por interagir com a tabela 'animais' do banco de dados.
 */
class AnimalModel {
    private $conn;

    public function __construct() {
        // Estabelece a conexão com o banco de dados ao instanciar o modelo
        $conexao = new ConexaoBD();
        $this->conn = $conexao->conectar();
    }

    /**
     * Busca animais no banco de dados, aplicando filtros opcionais.
     * @param string $especie Filtra por espécie (Gato, Cachorro).
     * @param string $idade Filtra por idade (Filhote, Jovem, Adulto, Idoso).
     * @param string $sexo Filtra por sexo (Macho, Fêmea).
     * @param string $nome Filtra por nome (LIKE).
     * @return array Array de animais encontrados.
     */
    public function buscarAnimais($especie = null, $idade = null, $sexo = null, $nome = null) {
        $sql = "SELECT id_animal, nome, especie, sexo, idade, castrado, porte, descricao, foto 
                FROM animais 
                WHERE 1=1"; // Começa com 1=1 para facilitar a adição de cláusulas AND

        $params = [];
        $types = "";

        // Adiciona filtro por Espécie
        if (!empty($especie)) {
            $sql .= " AND especie = ?";
            $types .= "s";
            $params[] = $especie;
        }

        // Adiciona filtro por Idade
        // Nota: A idade é armazenada como string (ex: 'Filhote', 'Idosa') na sua tabela
        if (!empty($idade)) {
            $sql .= " AND (idade = ? OR idade = ?)"; // Verifica a versão masculina e feminina (ex: 'Idoso' e 'Idosa')
            $types .= "ss";
            // Normaliza o filtro (ex: 'Adulto', 'Adulta')
            $baseIdade = substr($idade, 0, -1); // Remove a última letra
            $params[] = $idade;
            
            // Adiciona a forma alternativa de idade (ex: Filhote/Filhota)
            if ($idade == 'Filhote' || $idade == 'Jovem') {
                 $params[] = $idade . 'a'; // Ex: Filhotea, Jovema
            } else if ($idade == 'Adulto') {
                $params[] = 'Adulta';
            } else if ($idade == 'Idoso') {
                $params[] = 'Idosa';
            } else {
                 $params[] = $idade; // Adiciona o próprio valor novamente se não houver variação
            }
        }
        
        // Adiciona filtro por Sexo
        if (!empty($sexo)) {
            $sql .= " AND sexo = ?";
            $types .= "s";
            $params[] = $sexo;
        }

        // Adiciona filtro por Nome
        if (!empty($nome)) {
            $sql .= " AND nome LIKE ?";
            $types .= "s";
            $params[] = "%" . $nome . "%";
        }

        $sql .= " ORDER BY nome ASC"; // Ordena pelo nome para melhor visualização

        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            error_log("Erro na preparação da query: " . $this->conn->error);
            return []; // Retorna array vazio em caso de erro
        }

        // Se houver parâmetros, faz o bind
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $animais = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $animais;
    }
    
    /**
     * Busca um único animal pelo ID para o modal de detalhes.
     * @param int $id_animal ID do animal.
     * @return array|null Dados do animal ou null se não for encontrado.
     */
    public function buscarAnimalPorId($id_animal) {
        $sql = "SELECT id_animal, nome, especie, sexo, idade, castrado, porte, descricao, foto, ong, cidade 
                FROM animais 
                WHERE id_animal = ?";
        
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            error_log("Erro na preparação da query: " . $this->conn->error);
            return null;
        }

        $stmt->bind_param("i", $id_animal);
        $stmt->execute();
        $result = $stmt->get_result();
        $animal = $result->fetch_assoc();

        $stmt->close();
        return $animal;
    }
    
    
}
?>