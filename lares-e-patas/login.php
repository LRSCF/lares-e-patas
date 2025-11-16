<?php
session_start();
require_once 'usuario.php'; 
$erro = '';

if (isset($_POST['btnLogin'])) {
    $email = trim($_POST['txtLogin']);
    $senha = $_POST['txtSenha'];

    $usuario = new usuario();
    $dados_usuario = $usuario->logar($email, $senha);

    // 1. VERIFICA SE O LOGIN FOI BEM-SUCEDIDO (SE $dados_usuario NÃO É FALSE)
    if ($dados_usuario) {
        // --- BLOCo DE SUCESSO: SÓ EXECUTA SE HOUVER DADOS DE USUÁRIO ---
        
        // 2. CRIA AS VARIÁVEIS DE SESSÃO
        $_SESSION['id_usuario'] = $dados_usuario['id_usuario'];
        $_SESSION['nome'] = $dados_usuario['nome'];
        $_SESSION['tipo_usuario'] = $dados_usuario['tipo_usuario'];

        // 3. REDIRECIONA BASEADO NO TIPO DE USUÁRIO
        if ($dados_usuario['tipo_usuario'] == 'administrador') {
            header('Location: index.php');
        } else {
            header('Location: voluntariado.html'); 
        }
        exit; // MUITO IMPORTANTE: Parar a execução após o header()
        // -------------------------------------------------------------
    } else {
        // 4. BLOCo DE FALHA: EXIBE A MENSAGEM DE ERRO
        $erro = "E-mail ou senha inválidos! Tente novamente.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Lares e Patas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            background-image: url('img/logo.png');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        .login-box {
            max-width: 400px;
            background-color: #fff;
            margin: 100px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-box h2 {
            color: #b56a00; 
            margin-bottom: 20px;
        }

        .login-box input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
        }

        .btn {
            background-color: #f39c12;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #d98200;
        }

        .link {
            color: #b56a00;
            text-decoration: none;
            font-weight: bold;
        }

        .link:hover {
            text-decoration: underline;
        }

        .erro {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" name="txtLogin" placeholder="E-mail" required>
            <input type="password" name="txtSenha" placeholder="Senha" required><br>
            <button class="btn" type="submit" name="btnLogin">Entrar</button>
            <a class="btn" href="cadastro.php">Primeiro Acesso?</a>
        </form>

        <?php if ($erro != ''): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
