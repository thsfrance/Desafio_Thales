<?php

class IndexController extends MainController{
    
    public function index(){
        $this->title = 'Home';
        
        $parametros = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        
        require ABSPATH . '/views/_includes/header.php';
        
        require ABSPATH . '/views/_includes/menu.php';
        
        require ABSPATH . '/views/_includes/index-view.php';
        
        require ABSPATH . '/views/_includes/footer.php';
        
    } //index
    
}// class IndexController