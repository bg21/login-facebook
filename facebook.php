<?php    
    include('config.php');
    
    if(!isset($accessToken)) {
        //Url que tem o login
        $loginUrl = $helper->getLoginUrl($urlqueRealizaLogin, $permissions);
        //Recebe a url que realiza o login e o email.
    }else{
        //Url que tem o login
        $loginUrl = $helper->getLoginUrl($urlqueRealizaLogin, $permissions);
        //Recebe a url que realiza o login e o email.
        if(isset($_SESSION['acesso_token_fb'])){
            $fb->setDefaultAccessToken($_SESSION['acesso_token_fb']);
        }else{
            //Usuário não está autenticado
            //setando para a sessão o accessToken
            $_SESSION['acesso_token_fb'] = (string) $accessToken;
            //realizando o login
            $oAuth2Client = $fb->getOAuth2Client();
            //prolongando a vida da sessão
            $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['acesso_token_fb']);
            $_SESSION['acesso_token_fb'] = (string) $longLivedAccessToken;
            //requisitando as informações
            $fb->setDefaultAccessToken($_SESSION['acesso_token_fb']);
        }

            //obter as informações
            try {
                //estamos recuperando o nome, foto e email
                $response = $fb->get('/me?fields=name, picture, email');

                //retorna as informações do usuário
                $user = $response->getGraphUser();
                $nome = $user['name'];
                $email = $user['email'];   
                $foto = $user['picture']['url'];

                //Realiza a busca no Banco de Dados
                $sql = Conexao::conectar()->prepare("SELECT * FROM tb_usuarios WHERE email = ?");
                $sql->execute([$email]);

                if($sql->rowCount() == 1){
                    $info = $sql->fetch();
                    //Passa as informações do usuário recuperadas em sessões pra utilizarmos lá no main.php caso o usuário tenha realizado o login com o facebook.
                    $_SESSION['login'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['foto'] = $foto;
                    header("Location: main.php");
                    die();
                }else{
                    //Erro
                    echo ' Usuário não encontrado.';
                    //faça um redirecionamento aqui se quiser
                    die();
                }
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
    }
?>
