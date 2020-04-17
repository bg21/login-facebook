<?php
    include('config.php');  
    //Com esse objeto sempre que o usuário deslogar do sistema ele precisará fazer login novamente no facebook com a sua conta.
    $logoutUrl = $helper->getLogoutUrl($accessToken, $redirectUrl.'logout.php');
    //Se não existir a sessão do login comum/normal e a sessão do login realizado através do facebook então vamos redirecionar o usuário para a página inicial.
    if(!isset($_SESSION['login_comum']) && !isset($_SESSION['acesso_token_fb'])){
        header('Location: index.php');
        die();
    }
?>
<!--No login realizado pelo facebook nós criamos sessões para receber o nome, email e foto do usuário--->
<!--No login comum nós recuperamos da base de dados o nome, email e foto (caso exista)--->
<h2>Início - Bem vindo <?php echo $_SESSION['nome']; ?></h2>
<h3>Email: <?php echo $_SESSION['email']; ?></h3>
<img src="<?php echo $_SESSION['foto']; ?>" alt="">

<!--Se não existir a sessão que realiza o login do facebook então o logout será da forma comum, caso exista então vamos utilizar o logout que destrói a sessão do facebook--->
<?php
    if(!isset($_SESSION['acesso_token_fb'])){
?>
    <a href="logout.php?sair">Sair Normal</a>
<?php
    }else{   
?>
<a href="<?php echo $logoutUrl; ?>">Sair Facebook</a>
<?php
    }   
?>