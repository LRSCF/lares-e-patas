<?php
// Inclui o arquivo de conexão
require_once 'conexao.php';

// Inicialização da conexão
$db = new ConexaoBD(); 
$conexao = $db->conectar();

// 1. Variáveis de filtro
$especie_filtro = $_GET['especie'] ?? '';
$idade_filtro   = $_GET['idade']   ?? '';

// 2. Construção da Query SQL base
$sql = "SELECT * FROM animais WHERE 1=1";

// 3. Aplicação dos filtros

if (!empty($especie_filtro)) {
    $especie_filtro = $conexao->real_escape_string($especie_filtro);
    $sql .= " AND especie = '$especie_filtro'";
}

if (!empty($idade_filtro)) {
    $idade_filtro = $conexao->real_escape_string($idade_filtro);

    if ($idade_filtro === 'Filhote') {
        $sql .= " AND idade = 'Filhote'";
    } elseif ($idade_filtro === 'Adulto') {
        $sql .= " AND idade NOT IN ('Filhote', 'Filhotes')";
    } else {
        // Se for algum valor direto da coluna
        $sql .= " AND idade = '$idade_filtro'";
    }
}

// EXECUTA A QUERY
$resultado = $conexao->query($sql);

// Verifica se retornou resultados
if ($resultado) {
    $animais = $resultado->fetch_all(MYSQLI_ASSOC);
    $num_animais = count($animais);
} else {
    echo "<h2 style='color: red;'>ERRO NA QUERY SQL: " . $conexao->error . "</h2>";
    $animais = [];
    $num_animais = 0;
}

// Fecha a conexão
$conexao->close();

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lares & Patas - Animais para Adoção</title>
    <!-- Incluindo Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluindo Bootstrap Icons para os ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Paleta de Cores
            Laranja Principal: #ff8c00 
            Laranja Suave (Fundo): #fff8e1
            Marrom Escuro (Rodapé): #6c2d12
            Cor de Destaque/Títulos: #d9534f 
        */
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 70px;
            background-color: #f8f9fa; /* Fundo suave */
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 60px;
        }

        /* Títulos de Seção */
        .section-title {
            color: #d9534f;
            text-align: center;
            margin-top: 50px;
            margin-bottom: 30px;
            font-weight: 700;
        }

        /* Botões Personalizados */
        .btn-primary-custom {
            background-color: #ff8c00;
            border-color: #ff8c00;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: #e67e00;
            border-color: #e67e00;
            color: white;
        }
        
        /* Botões de Filtro */
        .btn-filter {
            background-color: #fff8e1;
            color: #ff8c00;
            border: 2px solid #ff8c00;
            font-weight: bold;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-filter:hover, .btn-filter.active {
            background-color: #ff8c00;
            color: white;
            border-color: #ff8c00;
        }

        /* Cards de Animais */

        .pet-card {
        max-height: 500px; 
        }

        .pet-card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%; /* Garante altura uniforme */
            max-height: 550px;
            display: flex;
            flex-direction: column;
        }

        .pet-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.15);
        }

        .pet-card img {
             object-fit: cover;
             height: 180px;
             width: 100%;
        }


        .pet-card .card-body {
            flex-grow: 1; /* Permite que o body se estenda para a altura total */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .pet-card .card-title {
            color: #d9534f;
            font-weight: 700;
        }
        
        /* Rodapé */
        footer {
            background-color: #6c2d12;
            color: #fff;
            padding: 30px 0;
            margin-top: 50px;
        }

        footer a {
            color: #ffc107;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <!-- Imagem de placeholder, substitua por seu logo.png -->
                <img src="https://placehold.co/180x60/f87702/ffffff?text=LARES%20%26%20PATAS" alt="Logo Lares & Patas">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <!-- Adoção está ativo nesta página -->
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="adocao.php">Adoção</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="doacao.html">Doação</a></li>
                    <li class="nav-item"><a class="nav-link" href="eventos.html">Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="voluntariado.html">Voluntariado</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Conteúdo Principal - Catálogo de Adoção -->
    <main class="container my-5">
        <h1 class="section-title">Nossos Amiguinhos à Espera</h1>
        <p class="text-center text-muted mb-5">Escolha seu novo melhor amigo!</p>

        <!-- Filtros e Busca -->
        <div class="d-flex justify-content-center flex-wrap gap-3 mb-4">
         <a href="adocao.php" class="btn btn-filter <?= (empty($especie_filtro) && empty($idade_filtro)) ? 'active' : '' ?>">
         <i class="bi bi-list-ul me-2"></i>Todos
     </a>

         <a href="adocao.php?especie=Cachorro" class="btn btn-filter <?= ($especie_filtro == 'Cachorro') ? 'active' : '' ?>">
         <i class="bi bi-house-door me-2"></i>Cães
     </a>

         <a href="adocao.php?especie=Gato" class="btn btn-filter <?= ($especie_filtro == 'Gato') ? 'active' : '' ?>">
         <i class="bi bi-journal-album me-2"></i>Gatos
     </a>
 
         <a href="adocao.php?idade=Filhote" class="btn btn-filter <?= ($idade_filtro == 'Filhote') ? 'active' : '' ?>">
         <i class="bi bi-star me-2"></i>Filhotes
     </a>

         <a href="adocao.php?idade=Adulto" class="btn btn-filter <?= ($idade_filtro == 'Adulto') ? 'active' : '' ?>">
         <i class="bi bi-activity me-2"></i>Adultos
     </a>
</div>

        <!-- Grid de Animais -->
<div class="row row-cols-1 row-cols-md-3 g-4">

 <?php if ($num_animais > 0): ?>
    <?php foreach ($animais as $animal): ?>
    
    <div class="col">
        <div class="card pet-card">
    
            <img src="img/<?= htmlspecialchars($animal['foto']) ?>" 
                 class="card-img-top" 
                 alt="<?= htmlspecialchars($animal['nome']) ?>, para adoção">

            <div class="card-body">
                <div>
                    <h5 class="card-title"><?= htmlspecialchars($animal['nome']) ?></h5>

                    <p class="card-text mb-1 small text-secondary">
                        <i class="bi bi-tag-fill me-1"></i>Porte: <?= htmlspecialchars($animal['porte']) ?>
                        | <i class="bi bi-calendar-check me-1"></i>Idade: <?= htmlspecialchars($animal['idade']) ?>
                    </p>

                    <p class="card-text mb-2 small text-secondary">
                        <i class="bi bi-gender-<?= ($animal['sexo'] == 'Macho' ? 'male' : 'female') ?> me-1"></i>
                        <?= htmlspecialchars($animal['sexo']) ?> 
                        | <i class="bi bi-patch-check-fill me-1"></i>
                        Castrado: <?= ($animal['castrado'] == 1 ? 'Sim' : 'Não') ?>
                    </p>

                    <p class="card-text text-muted small">
                        <?= htmlspecialchars(substr($animal['descricao'], 0, 80)) ?>...
                    </p>
                </div>

                <a href="perfil_animal.php?id=<?= $animal['id_animal'] ?>" 
                   class="btn btn-primary-custom w-100 mt-3 fw-bold">
                   Ver Perfil
                </a>
            </div>

        </div>
    </div>

    <?php endforeach; ?>


     <?php else: ?>
             <div class="col-12 text-center">
             <p class="lead text-danger">Nenhum animal encontrado com os filtros selecionados.</p>
             <a href="adocao.php" class="btn btn-primary-custom">Limpar Filtros</a>
         </div>
     <?php endif; ?>

</div>
        
        <!-- Botão Ver Mais -->
        <div class="text-center mt-5">
            <button class="btn btn-lg btn-primary-custom fw-bold">Ver Mais Animais (6 de 32)</button>
        </div>
    </main>

    <!-- Rodapé -->
    <footer>
        <div class="container text-center">
            <p>Rua dos Pinheiros, 1234 – Centro<br>Pinhalzinho - SP | CEP: 12995-987</p>
            <p>CNPJ: 12.345.678/0001-90</p>
            <p><a href="#">Política de Privacidade</a> | <a href="#">Termos de Uso</a></p>
            <p class="mt-3 mb-0">© 2025 Lares & Patas. Todos os direitos reservados.</p>
        </div>
    </footer>

    <!-- Incluindo Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // JS simples para simular o filtro (apenas visual)
        document.querySelectorAll('.btn-filter').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.btn-filter').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html> 