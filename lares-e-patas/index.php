<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lares & Patas - Adoção Responsável</title>
    <!-- Incluindo Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluindo Bootstrap Icons para os ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Paleta de Cores (Inspirada no Laranja e Marrom do Logo)
           Laranja Principal: #ff8c00 
           Laranja Suave (Fundo): #fff8e1
           Marrom Escuro (Rodapé): #6c2d12
           Cor de Destaque/Títulos: #d9534f 
        */
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 70px; 
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .navbar-brand img {
            height: 60px;
        }

        /* Hero Section */
        .hero-section {
        
            background: url('img/hero-bg.jpg') no-repeat center center; 
            background-size: cover;
            height: 400px; /* Altura controlada */
            position: relative;
    
    /* Overlay escuro para melhorar a leitura do texto */
            z-index: 1; 
}

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4); /* Transparência de 40% */
            z-index: -1;
}

        .hero-section .container {
            z-index: 2; 
}
        
        /* Títulos de Seção */
        .section-title {
            color: #d9534f; /* Laranja Avermelhado (Destaque) */
            text-align: center;
            margin-top: 50px;
            margin-bottom: 30px;
            font-weight: 700;
        }

        /* Cards de Missão/Visão/Valores */
        .card {
            border-radius: 12px;
            border: 1px solid #f0e0c0; 
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }
        
        .card i {
            font-size: 40px;
            color: #ff8c00; /* Laranja Principal nos ícones */
        }

        /* Botões */
        .btn-primary-custom {
            background-color: #ff8c00; /* Laranja Principal */
            border-color: #ff8c00;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-primary-custom:hover {
            background-color: #e67e00; /* Laranja um pouco mais escuro no hover */
            border-color: #e67e00;
            color: white;
        }

        /* Rodapé */
        footer {
            background-color: #e37323ff; 
            color: #ffffff;           
        }

        /* Estilo para os links no rodapé */
        footer .footer-link {
            color: #ffc107; 
            text-decoration: none;
            transition: color 0.3s;
        }

        footer .footer-link:hover {
            color: #ffd700; 
        }

        /* Classe para controlar o tamanho da Logo */
        .footer-logo {
            height: 100px; /* Ajuste este valor para deixar a logo do tamanho quedeseja */
            width: auto;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                
                <img src="img/logo.png" alt="Logo Lares & Patas">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="adocao.php">Adoção</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="doacao.html">Doação</a></li>
                    <li class="nav-item"><a class="nav-link" href="eventos.html">Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="voluntariado.html">Voluntariado</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-white text-center d-flex align-items-center justify-content-center">
    <div class="container py-5">
        <h1 class="display-3 fw-bold mb-3">
            0 SEU MELHOR AMIGO ESTÁ AQUI!
        </h1>
        <p class="lead mb-4">
            Adote com responsabilidade e mude uma vida. Dê um lar a quem precisa! 🐾
        </p>
        <a href="adocao.php" class="btn btn-primary-custom btn-lg shadow-lg">
            Ver Animais para Adoção
        </a>
    </div>
</section>

    <!-- Missão, Visão e Valores -->
    <div class="container text-center my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    
                    <i class="bi bi-heart"></i>
                    <h5 class="mt-3">Missão</h5>
                    <p>Oferecer abrigo, cuidado e reabilitação a todos os animais resgatados, garantindo seu bem-estar.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    <!-- Ícone de Olho Laranja -->
                    <i class="bi bi-eye"></i>
                    <h5 class="mt-3">Visão</h5>
                    <p>Ser referência nacional em adoção e proteção animal, promovendo a posse responsável.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 h-100 shadow-sm">
                    <!-- Ícone de Pessoas Laranja -->
                    <i class="bi bi-people"></i>
                    <h5 class="mt-3">Valores</h5>
                    <p>Empatia incondicional, respeito, transparência e compromisso com a vida animal.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Como Você Pode Ajudar -->
    <h2 class="section-title">Como Você Pode Ajudar</h2>
    <div class="container text-center mb-5">
        <div class="row g-4">
            <!-- Card Adoção -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    
                    <img src="https://placehold.co/600x400/ff8c00/ffffff?text=ADOTE" class="card-img-top" alt="Adoção">
                    <div class="card-body">
                        <h5 class="card-title">Adoção</h5>
                        <p class="card-text">Encontre seu novo companheiro leal e dê a ele um lar cheio de amor.</p>
                        
                        <a href="adocao.php" class="btn btn-primary-custom text-white fw-bold">Saiba Mais</a>
                    </div>
                </div>
            </div>

            <!-- Card Doação -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                   
                    <img src="https://placehold.co/600x400/d9534f/ffffff?text=DOA%C3%87%C3%83O" class="card-img-top" alt="Doação">
                    <div class="card-body">
                        <h5 class="card-title">Doação</h5>
                        <p class="card-text">Ajude nossa causa com doações de ração, medicamentos ou apoio financeiro.</p>
                        <a href="doacao.html" class="btn btn-danger text-white fw-bold">Saiba Mais</a>
                    </div>
                </div>
            </div>

            <!-- Card Voluntariado -->
            <div class="col-md-4">
                <div class="card h-100 shadow">
                    
                    <img src="https://placehold.co/600x400/ff8c00/ffffff?text=VOLUNTARIADO" class="card-img-top" alt="Voluntariado">
                    <div class="card-body">
                        <h5 class="card-title">Voluntariado</h5>
                        <p class="card-text">Faça parte do nosso time de amor e cuidado, doando seu tempo e carinho.</p>
                        <a href="voluntariado.html" class="btn btn-primary-custom text-white fw-bold">Saiba Mais</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rodapé -->
   <footer>
    <div class="container py-4">
        <div class="row align-items-center text-md-start text-center">
            
            <div class="col-md-3 mb-3 mb-md-0 d-flex justify-content-center justify-content-md-start">
                <img src="img/logo.png" alt="Lares & Patas Logo" class="footer-logo">
            </div>

            <div class="col-md-9 text-md-end">
                <p class="mb-1">Rua dos Pinheiros, 1234 – Centro, Pinhalzinho - SP | CEP: 12995-987</p>
                <p class="mb-1">CNPJ: 12.345.678/0001-90</p>
                <p class="mb-1">
                    <a href="#" class="footer-link">Política de Privacidade</a> | 
                    <a href="#" class="footer-link">Termos de Uso</a>
                </p>
                <p class="mt-3 mb-0">© 2025 Lares & Patas. Todos os direitos reservados.</p>
            </div>

        </div>
    </div>
</footer>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>