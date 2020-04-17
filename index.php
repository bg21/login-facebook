<?php
    include('facebook.php');
?>
<!DOCTYPE html>
<html lang="BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <title>Início</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
        <link type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="<?php echo $redirectUrl; ?>css/estilo.css">
    </head>
<body>
    <div class="container">
        <section class="login">
            <div class="head_login">
                <h2>Realizar Login</h2>
            </div>
            <div class="corpo_login">
                <form method="post" action="login.php">
                    <div class="input_group">
                        <label for="">Seu email: </label>
                        <input type="email" name="email" id="" placeholder="Seu email">
                    </div>
                    <div class="input_group">
                        <label for="">Sua senha: </label>
                        <input type="password" name="senha" id="" placeholder="Sua senha">
                    </div>
                    <div class="input_group">
                        <input type="submit" name="acao" id="" value="Entrar">
                    </div>
                </form>
            </div>
            <div class="footer_login">
                <a href="<?php echo $loginUrl; ?>">
                    <button type="button">
                        <i class="fab fa-facebook-square"></i>
                        Fazer Login com o Facebook
                    </button>
                </a>
            </div>
        </section>
</div>
</body>
</html>
