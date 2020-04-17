<?php
    session_start(); 
    require ('vendor/autoload.php'); 
    $fb = new \Facebook\Facebook([
        'app_id' => 'ID do Aplicativo',
        'app_secret' => 'Chave Secreta do Aplicativo',
        'default_graph_version' => 'v2.10',
        //'default_acs' => '{access-token}', // optional
    ]);
    
    //Você usará essas variáveis lá no arquivo facebook.php
    $permissions = ['email'];
    $urlqueRealizaLogin = 'http://localhost/Projetos/login_facebook/facebook.php';
    $redirectUrl = 'http://localhost/Projetos/login_facebook/';
    
    $helper = $fb->getRedirectLoginHelper();  

    try {
        if(isset($_SESSION['acesso_token_fb'])){
            $accessToken = $_SESSION['acesso_token_fb'];
        }else{
            $accessToken = $helper->getAccessToken('http://localhost/Projetos/login_facebook/facebook.php');
        }
        
    }catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    //Carregando as classes (Conexao) dinamicamente.
    $autoLoad = function($class){
        if(file_exists($class.'.php')){
            //aqui pra incluir as classes no blog
            include($class.'.php');
        }
    };
    spl_autoload_register($autoLoad);
?>