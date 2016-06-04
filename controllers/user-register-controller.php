<?php

class UserRgisterController extends MainController{
    public $login_required = true;
    public $permission_required = 'user-register';
    
    public function index(){
        $this->title = 'User Register';
        if(!$this->logged_in){
            $this->logout();
            $this->goto_login();
            
            return;
        }
        
        if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
            echo "Você não tem permissões para acessar essa página";
            return;
        }
        
        $parametros = (func_num_args() >= 1) ? func_get_arg(0) : array();
        
        $modelo = $this->load_model('user-register/user-register-model');
        
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/_includes/menu.php';
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/user-register/user-register-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }// index
}// class UserRegisterController
