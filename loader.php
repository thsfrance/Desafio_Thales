<?php

if(! defined('ABSPATH')) exit;

//Inicia Sessão
session_start();

if(!defined('DEBUG') || DEBUG === false){
    error_reporting(0);
    ini_set("display_errors",0);
} else {
    error_reporting(E_ALL);
    ini_set("diplay_errors", 1);
}

//Funções globais
require_once ABSPATH . '/functions/global-functions.php';

$desafio = new DesafioMVC();

?>