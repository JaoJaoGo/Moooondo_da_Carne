<?php
include('php/config.php');

function ValidaEmail($Email) {
    if(filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

if(isset($_POST['botaologin'])) {
    $emaillogin = $mysqli->real_escape_string($_POST['emaillogin']);
    $senhalogin = $mysqli->real_escape_string($_POST['senhalogin']);
    
    $sql_code = "SELECT * FROM usuarios WHERE email = '$emaillogin' LIMIT 1";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);
    
    $quantidade = $sql_query->num_rows;
    
    if($quantidade == 1) {
        $usuario = $sql_query->fetch_assoc();

        if(password_verify($senhalogin, $usuario['senha'])) {
            if(!isset($_SESSION)) {
                session_start();
            }
        
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
        
            header("Location: php/home.php");
        } else {
            echo '<script>var erroLogin = true; </script>';
        }
    } else {
        echo '<script>var erroLogin = true; </script>';
    }
}

if(isset($_POST['botaocadastro'])) {
    $nome = $_POST['nome'];
    $email = $_POST['emailcadastro'];
    $senha = $_POST['senhacadastro'];
    $senha_confirm = $_POST['senhacadastroconfirm'];
    
    if(ValidaEmail($email)) {
        $checar_email_code = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
        $checar_email_query = $mysqli->query($checar_email_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade_de_emails = $checar_email_query->num_rows;

        if($quantidade_de_emails == 0) {
            if($senha === $senha_confirm) {
                // Utilizando instrução preparada
                $stmt = $mysqli->prepare("INSERT INTO usuarios(nome, email, senha) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $nome, $email, $hash);
        
                // Hash da senha
                $hash = password_hash($senha, PASSWORD_BCRYPT);
        
                // Executar a instrução preparada
                $stmt->execute();
        
                // Fechar a instrução
                $stmt->close();
            } else {
                echo '<script>var erroCadastroSenha = true; </script>';
            }
        } else {
            echo '<script>var erroCadastroDuplicado = true; </script>';
        }
    } else {
        echo '<script>var erroCadastroEmail = true; </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/icons/icon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="./img/icons/iconApple.png">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./js/index.js"></script>
    <title>Moooondo da Carne</title>
</head>

<body>
    <div class="container">
        <img class="background_image" src="./img/background/signInImage.jpg">
        <img class="background_image" src="./img/background/signUpImage.jpg">

        <main class="box">
            <img class="logo_mobile" src="./img/Logo.png">

            <p class="apresentacao">Bem-vindo ao <br><span>Moooondo da Carne</span></p>
            
            <form action = '' method="POST">
                <div class="login">
                    <h1>Login</h1>

                    <p class="mensagemErroLogin">E-mail ou senha incorretos!</p>

                    <div class="loginCadastroItens">
                        <div class="inputs">
                            <label>E-mail</label>
                            <input type="text" name="emaillogin" required>
                        </div>
                        <div class="inputs">
                            <label>Senha</label>
                            <input type="password" id = "passwordLogin" name="senhalogin" required>
                            <i class="fa fa-eye" id="OlhoLogin" aria-hidden="true" onclick = "trocarSenha('passwordLogin', 'OlhoLogin')"></i>
                        </div>

                        <button type="submit" class="botaoLoginCadastro" name="botaologin">Entrar</button>

                        <button onclick="toggleLogin()" class="botaoCadastrar">Não possui uma conta? <span>Cadastre-se</span></button>
                    </div>
                </div>
            </form>

            <form action="index.php" method="POST">
                <div class="signUp">
                    <h1>Cadastro</h1>
                    
                    <p class="mensagemErroCadastroEmail">E-mail inválido!</p>
                    <p class="mensagemErroCadastroDuplicado">Esta conta já existe!</p>
                    <p class="mensagemErroCadastroSenha">As senhas digitadas não se coincidem!</p>

                    <div class="loginCadastroItens">
                        <div class="inputs">
                            <label>Nome</label>
                            <input type="text" name="nome" required>
                        </div>

                        <div class="inputs">
                            <label>E-mail</label>
                            <input type="text" name="emailcadastro" required>
                        </div>
                        <div class="inputs">
                            <label>Senha</label>
                            <input type="password" id="passwordCadastro" name="senhacadastro" required>
                            <i class="fa fa-eye" id="OlhoCadastro" aria-hidden="true" onclick = "trocarSenha('passwordCadastro', 'OlhoCadastro')"></i>
                        </div>
                        <div class="inputs">
                            <label>Confirmar Senha</label>
                            <input type="password" id="passwordCadastroConfirm" name="senhacadastroconfirm" required>
                            <i class="fa fa-eye" id="OlhoCadastroConfirm" aria-hidden="true" onclick = "trocarSenha('passwordCadastroConfirm', 'OlhoCadastroConfirm')"></i>
                        </div>
        
                        <button type="submit" class="botaoLoginCadastro" name="botaocadastro">Cadastrar</button>
        
                        <button onclick="toggleLogin()" class="botaoCadastrar">Já possui uma conta? <span>Clique aqui!</span></button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>

</html>