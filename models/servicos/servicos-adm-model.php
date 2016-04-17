<?php

class Servicos extends MainModel{
    public function __construct($db = false, $controller = null) {
        $this->$db = $db;
        
        $this->controller = $controller;
        
        $this->parametros = $this->controller->parametros;
        
        $this->userdata = $this->controller->userdata;
        
        echo 'Modelo carregado...<br>';
    }
}

