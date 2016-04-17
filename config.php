<?php
/**
 * Configuração geral
 */

//Caminho para a raiz
define('ABSPATH', dirname(__FILE__));

//URL da home
define('HOME_URI', 'http://127.0.0.1/Desafio_Thales');

//Nome do host da base de dados
define('HOSTNAME', 'localhost');

//Nome do DB
define('DB_NAME', 'desafio_thales');

//Usuário do DB
define('DB_USER','root');

//Senha do DB
define('DB_PASSWORD', 'masterkey');

//Charset da conexao PDO
define('DB_CHARSET', 'utf8');

//
define('DEBUG',true);

require_once ABSPATH . '/loader.php';

?>