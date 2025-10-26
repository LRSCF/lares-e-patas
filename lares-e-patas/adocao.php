<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";   
$password = "";      
$dbname = "laresepatas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Preparar filtros
$especie = $_GET['especie'] ?? '';
$porte = $_GET['porte'] ?? '';
$status = $_GET['status'] ?? 'disponível';
$nome = $_GET['nome'] ?? '';

// Montar query dinâmica
$sql = "SELECT * FROM animal WHERE status LIKE ?";
$params = ["%$status%"];

// Adicionando filtros
if ($especie) { $sql .= " AND especie LIKE ?"; $params[] = "%$especie%"; }
if ($porte) { $sql .= " AND porte LIKE ?"; $params[] = "%$porte%"; }
if ($nome) { $sql .= " AND nome LIKE ?"; $params[] = "%$nome%"; }

// Executando
$stmt = $conn->prepare($sql);
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
            
            <div class="col-md-2">
                <label class="form-label">Espécie</label>
                <select class="form-select" name="especie">
                    <option value="">Todas</option>
                    <option value="Cachorro">Cachorro</option>
                    <option value="Gato">Gato</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Porte</label>
                <select class="form-select" name="porte">
                    <option value="">Todos</option>
                    <option value="Pequeno">Pequeno</option>
                    <option value="Médio">Médio</option>
                    <option value="Grande">Grande</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="disponível">Disponíveis</option>
                    <option value="adotado">Adotados</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Nome do animal">
            </div>

            <div class="col-md-3 text-end">
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
        echo '
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">'.$row['nome'].'</h5>
                    <p class="text-muted small">'.$row['idade'].' anos | Porte: '.$row['porte'].' | '.$row['especie'].'</p>
                    <p>'.$row['historico'].'</p>
                    <span class="badge bg-'.($row['status'] == 'disponível' ? 'success' : 'secondary').'">'.$row['status'].'</span>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p class="text-center">Nenhum animal encontrado.</p>';
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

