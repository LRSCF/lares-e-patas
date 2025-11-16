<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Primeiro Acesso - Lares & Patas</title>

    <!-- W3.CSS e Ícones  -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Cores base */
        :root {
            --cor-principal: #b37a4c; 
            --cor-secundaria: #4d3f2a; 
            --cor-hover: #8a5f3a; 
        }

        body {
            
            background: #f8f8f8 url('img/bg-patas.png') repeat;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        /* Estilo do card de formulário */
        form {
            box-shadow: 0 8px 20px rgba(0,0,0,0.2); 
            border-radius: 12px;
            width: 35%; 
            max-width: 500px; 
            padding: 30px;
        }
        
        /* Título */
        h2 {
            color: var(--cor-secundaria);
            font-weight: 700;
            margin-bottom: 25px;
        }
        
        /* Contêiner de input para alinhamento horizontal */
        .input-group {
            display: flex;
            align-items: center; 
            margin-bottom: 16px; /* Espaçamento entre os campos */
        }

        /* cor secundária aos ícones */
        .input-group i {
            color: var(--cor-secundaria) !important;
            font-size: 1.5rem; /* Ajusta o tamanho do ícone */
            margin-right: 15px; /* Espaçamento entre ícone e campo */
            width: 20px; /* Garante que todos os ícones ocupem o mesmo espaço */
            text-align: center;
        }
        
        /* Garante que o input e o select ocupem o restante do espaço */
        .input-group input, .input-group select {
            flex-grow: 1;
            padding: 10px;
        }

        /* Estilo do botão de cadastro */
        button[name="btnCadastrar"] {
            background-color: var(--cor-principal) !important;
            color: white !important; 
            transition: background-color 0.3s;
            border: none;
            font-weight: bold;
        }
        
        button[name="btnCadastrar"]:hover {
            background-color: var(--cor-hover) !important;
        }

        /* Estilo para o link "Já tenho cadastro" */
        .w3-text-grey {
            color: var(--cor-secundaria) !important;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .w3-text-grey:hover {
            color: var(--cor-hover) !important;
        }

        /* Responsividade básica para telas menores */
        @media (max-width: 768px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>

  <form action="" method="post" 
        class="w3-container w3-card-4 w3-light-grey w3-margin"
        style="width: 35%;">
    
    <h2 class="w3-center">Primeiro Acesso (Cadastro)</h2>

    <!-- Campo Nome Completo -->
    <div class="input-group">
      <i class="fa fa-user"></i>
      <input class="w3-input w3-border w3-round-large" name="txtNome" type="text" placeholder="Nome Completo" required>
    </div>

    <!-- Campo CPF -->
    <div class="input-group">
      <i class="fa fa-id-card"></i>
      <input class="w3-input w3-border w3-round-large" name="txtCPF" type="text" placeholder="CPF (Apenas números)" required>
    </div>

    <!-- Campo Email -->
    <div class="input-group">
      <i class="fa fa-envelope-o"></i>
      <input class="w3-input w3-border w3-round-large" name="txtEmail" type="email" placeholder="Email" required>
    </div>

    <!-- Campo Telefone -->
    <div class="input-group">
      <i class="fa fa-phone"></i>
      <input class="w3-input w3-border w3-round-large" name="txtTelefone" type="text" placeholder="Telefone (Opcional)">
    </div>
    
    <!-- Campo Senha -->
    <div class="input-group">
      <i class="fa fa-lock"></i>
      <input class="w3-input w3-border w3-round-large" name="txtSenha" type="password" placeholder="Senha" required>
    </div>
    
    <!-- Campo Tipo de Usuário (Select) -->
    <div class="input-group">
      <i class="fa fa-users"></i>
      <select class="w3-select w3-border w3-round-large" name="slTipoUsuario" required>
        <option value="" disabled selected>Escolha seu perfil...</option>
        <option value="adotante">Adotante</option>
        <option value="voluntario">Voluntário</option>
      </select>
    </div>

    <div class="w3-center w3-section" style="margin-top: 25px;">
      <button name="btnCadastrar" class="w3-button w3-block w3-margin w3-cell w3-round-large"
              style="width: 90%;">Cadastrar</button>
    </div>
    
    <div class="w3-center w3-section">
        <a href="login.php" class="w3-text-grey">Já tenho cadastro</a>
    </div>

  </form>

</body>
</html>