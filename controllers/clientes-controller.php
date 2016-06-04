<?php

class ClientesController extends MainController{
    public $login_required = false;
    public $permission_required;
    
    public function index(){
        $this->title = 'Clientes';
        
        $modelo = $this->load_model('/clientes/clientes-adm-model');
        
        require ABSPATH . '/views/_includes/header.php';
        require ABSPATH . '/views/_includes/menu.php';
        require ABSPATH . '/views/clientes/clientes-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    } // index
    
    public function adm() {
	// Page title
	$this->title = 'Gerenciar notícias';
	$this->permission_required = 'gerenciar-noticias';
		
	// Verifica se o usuário está logado
	if ( ! $this->logged_in ) {
		
            // Se não; garante o logout
            $this->logout();
			
            // Redireciona para a página de login
            $this->goto_login();
			
            // Garante que o script não vai passar daqui
            return;
		
	}
        
        if (!$this->check_permissions($this->permission_required, $this->userdata['user_permissions'])) {
            // Exibe uma mensagem
            echo 'Você não tem permissões para acessar essa página.';
            // Finaliza aqui
            return;
	}
        
        $modelo = $this->load_model('clientes/clientes-adm-model');
        require ABSPATH . '/views/_includes/menu.php';
        require ABSPATH . '/views/_includes/menu.php';
        require ABSPATH . '/views/noticias/clientes-adm-view.php';
        require ABSPATH . '/views/_includes/footer.php';
    }// adm
}// class ClientesController