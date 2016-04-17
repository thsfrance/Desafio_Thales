<?php

/**
 * DesafioMVC - Gerencia Models, Controllers e Views
 *
 * @package DesafioMVC
 * @since 0.1
 */

class DesafioMVC{
    private $controlador;
    private $acao;
    private $parametros;
    private $not_found = '/includes/404.php';
    
    public function __construct() {
        $this->get_url_data();
        if(! $this->controlador){
            require_once ABSPATH . '/controllers/index-controller.php';
            $this->controlador = new HomeController();
            $this->controlador->index();
            return;
        }
        
        if(!file_exists(ABSPATH . '/controllers/' . $this->controlador . '.php')){
            require_once ABSPATH . $this->not_found;
            return;
        }
        
        require_once ABSPATH . '/controllers/' . $this->controlador . '.php';
        
        $this->controlador = preg_replace('/[^a-zA-Z]/i', '', $this->controlador);
        
        if(!class_exists($this->controlador)){
            require_once ABSPATH . $this->not_found;
            return;
        }
        
        $this->controlador = new $this->controlador($this->parametros);
        
        if(method_exists($this->controlador,$this->acao)){
            $this->controlador->{$this->acao}($this->parametros);
            return;
        }
        
        if(!$this->acao && method_exists($this->controlador, 'index')){
            $this->controlador->index($this->parametros);
            return;
        }
        require_once ABSPATH . $this->not_found;
        return;
    }// __construtc
    
    public function get_url_data(){
        if(isset($_GET['path'])){
            $path = $_GET['path'];
            $path = rtrim($path, '/');
            $path = filter_var($path, FILTER_SANITIZE_URL);
            if(strripos($path,".php")) $path = substr($path,0,strlen($path)-4);
            $path = explode('/',$path);
            
            $this->controlador  = chk_array($path, 0);
            $this->controlador .= '-controller';
            $this->acao         = chk_array($path, 1);
            
            if(chk_array($path, 2)){
                unset($path[0]);
                unset($path[1]);
                
                $this->parametros = array_values($path);
            }
            
            // DEBUG
            //
            echo $this->controlador . '<br>';
            echo $this->acao        . '<br>';
            echo '<pre>';
            print_r( $this->parametros );
            echo '</pre>';
        }
    }// get_url_data
}// class DesafioMVC

?>
