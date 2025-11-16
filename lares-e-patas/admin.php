<?php
// Inicia a sessão para acessar as variáveis salvas
session_start();

// 1. Verifica se o usuário está logado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php'); // Se não estiver logado, volta para o login
    exit();
}

// 2. Verifica se o usuário é administrador (segurança)
if ($_SESSION['tipo_usuario'] != 'administrador') {
    // Se for outro tipo (voluntario/adotante), pode redirecionar ou mostrar erro
    header('Location: index.php'); 
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área Administrativa - Lares & Patas</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body { background-color: #f0f0f0; }
        .w3-container { background-color: white; margin-top: 50px; border-radius: 12px; }
    </style>
</head>
<body>

<div class="w3-container w3-card-4 w3-margin" style="max-width: 600px;">
    <h2 class="w3-text-teal">Painel de Administração</h2>
    <p>Olá, <strong><?php echo $_SESSION['nome']; ?></strong>!</p>
    <p>Seu acesso foi confirmado com sucesso. Você está logado como **<?php echo $_SESSION['tipo_usuario']; ?>**.</p>
    
    <hr>
    
    <p>Aqui você poderá gerenciar:</p>
    <ul class="w3-ul w3-card">
        <li><i class="fa fa-paw"></i> Cadastro e Edição de Animais</li>
        <li><i class="fa fa-users"></i> Gerenciamento de Voluntários</li>
        <li><i class="fa fa-calendar"></i> Criação e Edição de Eventos</li>
    </ul>

    <p class="w3-padding-large">
        <a href="logout.php" class="w3-button w3-red w3-round-large">Sair (Logout)</a>
    </p>
</div>

</body>
</html>