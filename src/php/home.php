<?php
include('protect.php');

// Ao clicar no botão de logout, finaliza a sessão e envia o usuário ao site de login
if(isset($_POST['logout'])) {
    session_destroy();

    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/icons/icon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="../img/icons/iconApple.png">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home - Moooondo da Carne</title>
</head>

<body>
    <form action='' method="POST">
        <div class="container">
            <img class="logo-image" src="../img/Logo.png" alt="Moooondo da Carne - Logo">

            <div class="textos">
                <h1>Em manutenção!</h1>
                <p>Olá <b><?php echo $_SESSION['nome'];?></b>! Nosso site está em manutenção.<br>Em breve voltaremos!</p>
            </div>

            <button type="submit" class="logout" name="logout">Voltar para o Login</button>
        </div>
    </form>

    <footer>
        <div class="links">
            <h2>CONTATO</h2>

            <div class="telEmail">
                <img src="../img/icons/email.png" alt="Icone Telefone">
                <p>jvgcarrijo@gmail.com</p>
            </div>

            <div class="telEmail">
                <img src="../img/icons/telefone.png" alt="Icone Email">
                <p>+55 (62) 98120-5855</p>
            </div>

            <a href="https://www.linkedin.com/in/jo%C3%A3o-v%C3%ADctor-guedes-carrijo-354aa01b5?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3BNUj8IzSnRauV4q4tD2FrJQ%3D%3D" target="_blank">
                <img src="../img/icons/linkedin.png" alt="Linkedin" class="linkedinLogo">
            </a>
        </div>
    </footer>
</body>

</html>