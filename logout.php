<?php
    include('config.php');  
    
    if(isset($_SESSION['login_comum'])){
        session_destroy();
        header('Location: index.php');
        die();
    }else{
        unset($_SESSION['acesso_token_fb']);
        session_destroy();
        header('Location: index.php');
        die();
    }
?>