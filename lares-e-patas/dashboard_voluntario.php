<?php
// dashboard_adotante.php

// Garante que o usuário esteja logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("location: login.php");
    exit;
}

$nome_usuario = $_SESSION['user_nome'];
$tipo_usuario = $_SESSION['user_tipo'];

// Função para gerar o link de logout (a ser implementado no logout.php)
$logout_link = 'logout.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Adoções - Lares & Patas</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        :root {
            --cor-principal: #b37a4c; 
            --cor-secundaria: #4d3f2a; 
        }
        body { background-color: #f8f8f8; font-family: 'Poppins', sans-serif; }
        .w3-bar { background-color: var(--cor-principal); color: white; }
        .dashboard-container { max-width: 1000px; margin-top: 50px; }
        .w3-card-pet { border-left: 5px solid var(--cor-principal); }
        .w3-tag-status { padding: 5px 10px; border-radius: 6px; font-weight: bold; }
        .status-pendente { background-color: #ff9800; color: white; }
        .status-aprovado { background-color: #4CAF50; color: white; }
        .status-rejeitado { background-color: #f44336; color: white; }
    </style>
</head>
<body>

<!-- Top Bar de Navegação -->
<div class="w3-bar w3-padding w3-card-4 w3-top">
    <a href="#" class="w3-bar-item w3-button w3-text-white w3-large w3-hide-small"><i class="fa fa-paw"></i> Lares & Patas</a>
    <span class="w3-bar-item w3-right w3-text-white">
        Olá, **<?php echo htmlspecialchars($nome_usuario); ?>**
        <a href="<?php echo $logout_link; ?>" class="w3-bar-item w3-button w3-hover-none w3-hover-text-light-grey w3-right"><i class="fa fa-sign-out"></i> Sair</a>
    </span>
    
</div>

<div class="w3-container dashboard-container w3-margin-top w3-animate-opacity">
    
    <div class="w3-center w3-margin-bottom">
        <h2>Área do Adotante</h2>
        <p class="w3-text-grey">Acompanhe suas candidaturas e encontre seu novo melhor amigo!</p>
    </div>

    <div class="w3-row-padding">
        
        <!-- Card 1: Status das Candidaturas -->
        <div class="w3-half w3-margin-bottom">
            <div class="w3-card w3-white w3-round-large w3-padding w3-card-pet">
                <h4>Minhas Candidaturas</h4>
                <p>Você tem **1 candidatura** em análise.</p>
                <button class="w3-button w3-small w3-border w3-border-amber w3-text-amber w3-round-large">Ver Detalhes</button>
            </div>
        </div>
        
        <!-- Card 2: Buscar Animais -->
        <div class="w3-half w3-margin-bottom">
            <div class="w3-card w3-white w3-round-large w3-padding w3-card-pet">
                <h4>Encontrar um Pet</h4>
                <p>Explore todos os animais disponíveis para adoção.</p>
                <button class="w3-button w3-small w3-block" style="background-color: var(--cor-secundaria); color: white;">Ver Animais</button>
            </div>
        </div>
    </div>
    
    <!-- Tabela de Acompanhamento -->
    <div class="w3-card w3-white w3-round-large w3-margin-top w3-padding">
        <h4>Histórico de Adoções</h4>
        <table class="w3-table w3-striped w3-bordered w3-hoverable">
            <thead>
                <tr class="w3-light-grey">
                    <th>Animal</th>
                    <th>Data da Candidatura</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Thor (Cachorro)</td>
                    <td>20/09/2024</td>
                    <td><span class="w3-tag-status status-pendente">Pendente</span></td>
                </tr>
                <tr>
                    <td>Fumaça (Gato)</td>
                    <td>01/08/2024</td>
                    <td><span class="w3-tag-status status-aprovado">Aprovado</span></td>
                </tr>
                <tr>
                    <td>Pipoca (Roedor)</td>
                    <td>15/07/2024</td>
                    <td><span class="w3-tag-status status-rejeitado">Rejeitado</span></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>