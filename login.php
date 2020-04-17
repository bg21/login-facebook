<?php
    include('config.php');
    if(isset($_POST['acao'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = Conexao::conectar()->prepare("SELECT * FROM tb_usuarios WHERE email = ?");
        $sql->execute([$email]);

        if($sql->rowCount() == 1){
            $info = $sql->fetch();
            if(password_verify($senha, $info['senha'])){
                $_SESSION['login_comum'] = true;
                $_SESSION['id'] = $info['id'];
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['email'] = $info['email'];
                header("Location: main.php");
                die();
            }else{
                //Erro
                echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Senha incorreta! </p></div>';
                die();
            //faça um redirecionamento aqui se quiser
            }
        }else{
            //Erro
            echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Usuário não encontrado.</p></div>';
            die();
            //faça um redirecionamento aqui se quiser
        }
    }
?>