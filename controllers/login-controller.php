<?php

class LoginController extends MainController{
    public function index(){
        $this->title = 'Login';
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
        
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/_includes/menu.php';
        require ABSPATH . '/views/login/login-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }// index
    
    public function sair($logout = false){
        if($logout){
            $this->logout(true);
        }
        
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/_includes/menu.php';
        require ABSPATH . '/views/login/login-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }
}// class LoginController