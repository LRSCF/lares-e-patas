<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "seu_usuario";
$password = "sua_senha";
$dbname = "nome_do_banco";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Conexão falhou: " . $conn->connect_error); }

// Preparar filtros
$especie = $_GET['especie'] ?? '';
$sexo = $_GET['sexo'] ?? '';
$porte = $_GET['porte'] ?? '';
$cidade = $_GET['cidade'] ?? '';
$status = $_GET['status'] ?? 'disponível';
$nome = $_GET['nome'] ?? '';

// Montar query dinâmica
$sql = "SELECT * FROM animais WHERE status LIKE ?";
$params = ["%$status%"];

if ($especie) { $sql .= " AND especie LIKE ?"; $params[] = "%$especie%"; }
if ($sexo) { $sql .= " AND sexo LIKE ?"; $params[] = "%$sexo%"; }
if ($porte) { $sql .= " AND porte LIKE ?"; $params[] = "%$porte%"; }
if ($cidade) { $sql .= " AND cidade LIKE ?"; $params[] = "%$cidade%"; }
if ($nome) { $sql .= " AND nome LIKE ?"; $params[] = "%$nome%"; }

// Preparar e executar statement
$stmt = $conn->prepare($sql);

// Bind dinâmico (PHP 8+)
$stmt->bind_param(str_repeat('s', count($params)), ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adoção | Lares & Patas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include 'includes/header.php'; ?>

    <!-- Filtros -->
    <section class="py-4" style="background: linear-gradient(to right, #ffa07a, #f6c4cc);">
        <div class="container">
            <form class="row g-3 align-items-end" method="GET">
                <!-- Campos de filtro -->
                <div class="col-md-2">
                    <label class="form-label">Espécie</label>
                    <select class="form-select" name="especie">
                        <option value="">Todas</option>
                        <option value="Cachorro">Cachorros</option>
                        <option value="Gato">Gatos</option>
                    </select>
                </div>
                <!-- Adicione os outros filtros aqui (sexo, porte, cidade, status, nome) -->
                <div class="col-12 text-end mt-2">
                    <button type="submit" class="btn btn-dark px-4">Buscar</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Cards -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-4">
                                <div class="card border-0 shadow-sm">
                                    <img src="img/'.$row['imagem'].'" class="card-img-top" alt="'.$row['nome'].'">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$row['nome'].'</h5>
                                        <p class="text-muted small">'.$row['idade'].' anos</p>
                                        <p>'.$row['descricao'].'</p>
                                        <button class="btn btn-warning w-100 text-white">Adotar</button>
                                    </div>
                                </div>
                              </div>';
                    }
                } else {
                    echo '<p class="text-center">Nenhum animal disponível no momento.</p>';
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
