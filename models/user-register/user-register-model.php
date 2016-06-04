<?php

class UserRegisterModel{
    public $form_data;
    public $form_msg;
    public $db;
    
    public function _construct(){
        $this->db = $db;
    }
    
    public function validate_register_form(){
        $this->form_data = array();
        
        if('POST' == $_SERVER['REQUEST_METHOD'] && ! empty($_POST)){
            foreach($_POST as $key => $value){
                $this->form_data[$key] = $value;
                if($empty($value)){
                    $this->form_msg = '<p class="form_error">There are empty fields. Data has not been sent.</p>';
                    return;
                }
            }
        } else {
          return;  
        }
        
        if(empty($this->form_data)){
            return;
        }
        
        $db_check_user = $this->db->query (
			'SELECT * FROM `users` WHERE `user` = ?', 
			array( 
				chk_array( $this->form_data, 'user')		
			) 
		);
        
        if(!$db_check_user){
            $this->form_msg = '<p class="form_error">Internal error.</p>';
            return;
        }
        $fetch_user = $db_check_user->fetch();
        $user_id = $fetch_user['user_id'];
        $password_hash = new PasswordHash(8, FALSE);
        
        $password = $password_hash->HashPassword( $this->form_data['user_password'] );
        
        if ( preg_match( '/[^0-9A-Za-z,.-_s ]/is', $this->form_data['user_permissions'] ) ) {
            $this->form_msg = '<p class="form_error">Use just letters, numbers and a comma for permissions.</p>';
            return;
	}	
        
        $permissions = array_map('trim', explode(',', $this->form_data['user_permissions']));
        $permissions = array_unique( $permissions );
        $permissions = array_filter( $permissions );
        $permissions = serialize( $permissions );
        
        if ( ! empty( $user_id ) ) {
            $query = $this->db->update('users', 'user_id', $user_id, array(
				'user_password' => $password, 
				'user_name' => chk_array( $this->form_data, 'user_name'), 
				'user_session_id' => md5(time()), 
				'user_permissions' => $permissions, 
			));
            
            if ( ! $query ) {
				$this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';
				
				// Termina
				return;
			} else {
				$this->form_msg = '<p class="form_success">User successfully updated.</p>';
				
				// Termina
				return;
			}
		// Se o ID do usuário estiver vazio, insere os dados
        } else {
		
		// Executa a consulta 
		$query = $this->db->insert('users', array(
				'user' => chk_array( $this->form_data, 'user'), 
				'user_password' => $password, 
				'user_name' => chk_array( $this->form_data, 'user_name'), 
				'user_session_id' => md5(time()), 
				'user_permissions' => $permissions, 
			));
			
			// Verifica se a consulta está OK e configura a mensagem
            if ( ! $query ) {
		$this->form_msg = '<p class="form_error">Internal error. Data has not been sent.</p>';
		// Termina
		return;
            } else {
                $this->form_msg = '<p class="form_success">User successfully registered.</p>';
		// Termina
		return;
            }
	}
    }// validate_register_form
    
    public function get_register_form ( $user_id = false ) {
        $s_user_id = false;
        if ( ! empty( $user_id ) ) {
            $s_user_id = (int)$user_id;
	}
        
        if ( empty( $s_user_id ) ) {
            return;
        }
        
        $query = $this->db->query('SELECT * FROM `users` WHERE `user_id` = ?', array( $s_user_id ));
        
        if ( ! $query ) {
            $this->form_msg = '<p class="form_error">Usuário não existe.</p>';
            return;
	}
        
        $fetch_userdata = $query->fetch();
        
        if ( empty( $fetch_userdata ) ) {
            $this->form_msg = '<p class="form_error">User do not exists.</p>';
            return;
	}
        
        foreach ( $fetch_userdata as $key => $value ) {
            $this->form_data[$key] = $value;
	}
        
        $this->form_data['user_password'] = null;
        
        $this->form_data['user_permissions'] = unserialize($this->form_data['user_permissions']);
        
        $this->form_data['user_permissions'] = implode(',', $this->form_data['user_permissions']);
        
    }// get_register_form
    
    public function del_user ( $parametros = array() ) {
        
        $user_id = null;
        if ( chk_array( $parametros, 0 ) == 'del' ) {
 
            // Mostra uma mensagem de confirmação
            echo '<p class="alert">Tem certeza que deseja apagar este valor?</p>';
            echo '<p><a href="' . $_SERVER['REQUEST_URI'] . '/confirma">Sim</a> | 
            <a href="' . HOME_URI . '/user-register">Não</a> </p>';
			
            // Verifica se o valor do parâmetro é um número
            if ( 
		is_numeric( chk_array( $parametros, 1 ) )
		&& chk_array( $parametros, 2 ) == 'confirma' 
            ) {
                // Configura o ID do usuário a ser apagado
                $user_id = chk_array( $parametros, 1 );
            }
	}
        
        if ( !empty( $user_id ) ) {
		
            // O ID precisa ser inteiro
            $user_id = (int)$user_id;
	
            // Deleta o usuário
            $query = $this->db->delete('users', 'user_id', $user_id);
			
            // Redireciona para a página de registros
            echo '<meta http-equiv="Refresh" content="0; url=' . HOME_URI . '/user-register/">';
            echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/user-register/";</script>';
            return;
	}
    }// del_user
    
    
    public function get_user_list() {
	
	// Simplesmente seleciona os dados na base de dados 
	$query = $this->db->query('SELECT * FROM `users` ORDER BY user_id DESC');
		
	// Verifica se a consulta está OK
	if ( ! $query ) {
            return array();
	}
	// Preenche a tabela com os dados do usuário
        return $query->fetchAll();
    } // get_user_list

}

