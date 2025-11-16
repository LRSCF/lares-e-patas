<?php
// dashboard_admin.php

// Garante que o usuário esteja logado e que este arquivo não seja acessado diretamente
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("location: login.php");
    exit;
}

// A variável $nome_usuario e $tipo_usuario vêm do index.php que incluiu este arquivo.
$nome_usuario = $_SESSION['user_nome'];
$tipo_usuario = $_SESSION['user_tipo'];

// Função para gerar o link de logout (a ser implementado no logout.php)
$logout_link = 'logout.php';

// Verificação de permissão (extra, mas importante)
if ($tipo_usuario !== 'administrador') {
    // Se, por algum erro, um adotante tentar acessar o painel do admin
    header("location: index.php"); // Redireciona para o index para correção
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Lares & Patas</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        :root {
            --cor-principal: #b37a4c; 
            --cor-secundaria: #4d3f2a; 
            --cor-hover: #8a5f3a; 
        }
        body { background-color: #f8f8f8; font-family: 'Poppins', sans-serif; }
        .w3-sidebar { background-color: var(--cor-secundaria); color: white; width: 250px; }
        .w3-bar-item:hover { background-color: var(--cor-hover) !important; color: white !important; }
        .logo-text { font-size: 1.5rem; padding: 16px; font-weight: bold; color: white; }
        .welcome-header { background-color: white; color: var(--cor-secundaria); box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .admin-card { border-left: 5px solid var(--cor-principal); }
        .w3-top { z-index: 1000; }
        
        /* Estilos de responsividade para o menu lateral */
        @media (max-width: 600px) {
            #main { margin-left: 0 !important; }
            #sidebar { display: none; }
        }
        @media (min-width: 601px) {
            #main { margin-left: 250px; }
        }
    </style>
</head>
<body>

<!-- Menu Lateral (Sidebar) -->
<nav class="w3-sidebar w3-collapse" id="sidebar">
    <div class="logo-text w3-center">
        <i class="fa fa-paw"></i> Lares & Patas
    </div>
    <div class="w3-bar-block">
        <h6 class="w3-padding w3-text-light-grey">GERENCIAMENTO</h6>
        <a href="#" class="w3-bar-item w3-button w3-hover-main"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-main"><i class="fa fa-users fa-fw"></i> Usuários</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-main"><i class="fa fa-calendar-check-o fa-fw"></i> Candidaturas</a>
        <a href="#" class="w3-bar-item w3-button w3-hover-main"><i class="fa fa-bug fa-fw"></i> Animais</a>
        
        <h6 class="w3-padding w3-text-light-grey" style="margin-top: 20px;">SISTEMA</h6>
        <a href="<?php echo $logout_link; ?>" class="w3-bar-item w3-button w3-hover-main"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
    </div>
</nav>

<!-- Overlay do Menu para Mobile -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<!-- Conteúdo Principal -->
<div class="w3-main" id="main">

    <!-- Header do Conteúdo (Top Bar) -->
    <div class="w3-bar w3-padding welcome-header w3-top">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-gray" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </button>
        <span class="w3-bar-item w3-right w3-text-grey">
            Olá, **<?php echo htmlspecialchars($nome_usuario); ?>** (<?php echo ucfirst($tipo_usuario); ?>)
        </span>
    </div>

    <!-- Padding para o Header Fixo -->
    <div style="height: 70px;"></div> 

    <div class="w3-container w3-padding-large">
        
        <h2>Painel de Administração</h2>
        <p class="w3-text-grey">Visão geral e acesso a todas as funcionalidades do sistema.</p>
        
        <div class="w3-row-padding w3-margin-top">
            
            <!-- Card de Visão Geral 1 -->
            <div class="w3-quarter">
                <div class="w3-card w3-container w3-white w3-margin-bottom w3-padding admin-card w3-round-large">
                    <p>Candidaturas Pendentes</p>
                    <h3 class="w3-text-red">12</h3>
                    <i class="fa fa-calendar-times-o w3-xlarge w3-right w3-text-red"></i>
                </div>
            </div>
            
            <!-- Card de Visão Geral 2 -->
            <div class="w3-quarter">
                <div class="w3-card w3-container w3-white w3-margin-bottom w3-padding admin-card w3-round-large">
                    <p>Animais para Adoção</p>
                    <h3 class="w3-text-orange">35</h3>
                    <i class="fa fa-paw w3-xlarge w3-right w3-text-orange"></i>
                </div>
            </div>
            
            <!-- Card de Visão Geral 3 -->
            <div class="w3-quarter">
                <div class="w3-card w3-container w3-white w3-margin-bottom w3-padding admin-card w3-round-large">
                    <p>Voluntários Ativos</p>
                    <h3 class="w3-text-blue">48</h3>
                    <i class="fa fa-handshake-o w3-xlarge w3-right w3-text-blue"></i>
                </div>
            </div>

            <!-- Card de Visão Geral 4 -->
            <div class="w3-quarter">
                <div class="w3-card w3-container w3-white w3-margin-bottom w3-padding admin-card w3-round-large">
                    <p>Adoções Concluídas</p>
                    <h3 class="w3-text-green">150</h3>
                    <i class="fa fa-heart w3-xlarge w3-right w3-text-green"></i>
                </div>
            </div>
        </div>

        <!-- Conteúdo Principal (Exemplo de Tabela) -->
        <div class="w3-row w3-margin-top">
            <div class="w3-col l12">
                <div class="w3-card w3-white w3-round-large w3-padding">
                    <h4>Candidaturas Recentes</h4>
                    <table class="w3-table w3-striped w3-bordered w3-hoverable">
                        <thead>
                            <tr class="w3-text-white" style="background-color: var(--cor-principal);">
                                <th>Candidato</th>
                                <th>Animal</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ana Silva</td>
                                <td>Rex (Cachorro)</td>
                                <td><span class="w3-tag w3-yellow w3-round-large">Pendente</span></td>
                                <td><button class="w3-button w3-small w3-teal">Ver Detalhes</button></td>
                            </tr>
                            <tr>
                                <td>João Souza</td>
                                <td>Mia (Gata)</td>
                                <td><span class="w3-tag w3-green w3-round-large">Aprovada</span></td>
                                <td><button class="w3-button w3-small w3-teal">Ver Detalhes</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
    
</div>

<script>
    // Função para abrir e fechar o sidebar em telas pequenas
    var mySidebar = document.getElementById("sidebar");
    var overlayBg = document.getElementById("myOverlay");
    var main = document.getElementById("main");

    function w3_open() {
        if (mySidebar.style.display === 'block') {
            w3_close();
        } else {
            mySidebar.style.display = 'block';
            overlayBg.style.display = "block";
        }
    }

    function w3_close() {
        mySidebar.style.display = "none";
        overlayBg.style.display = "none";
    }

    // Configura o padding do conteúdo principal para telas grandes
    if (window.innerWidth > 600) {
        main.style.marginLeft = "250px";
    }
</script>
</body>
</html>