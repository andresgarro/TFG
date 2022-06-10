<?php
require_once('db_abstract_model.php');
class Usuario extends DBAbstractModel {
	public $usuario;
	public $correo;
	public $clave;
	protected $id;
	
	public function get($user_email='') {
		if($user_email != ''):
			$this->query = "
			SELECT id_user, usuario, correo, clave
			FROM usuarios
			WHERE correo = '$user_email'";
		
			$this->get_results_from_query();
		endif;
		
		if(count($this->rows) == 1) {
			foreach ($this->rows[0] as $propiedad=>$valor) {
				$this->$propiedad = $valor;
			}
			$this->mensaje = '*Usuario encontrado';
		} else {
			$this->mensaje = '*Usuario no encontrado';
		}
		
	}

	public function get_l($user_log=array()) {
		if(array_key_exists('correo', $user_log)){
			$correo_l = $user_log['correo'];
			$clave_l = $user_log['clave'];
			$this->query = "
			SELECT id_user, usuario, correo, clave
			FROM usuarios
			WHERE correo = '$correo_l' AND clave = '$clave_l'";
			$this->get_results_from_query();
		}
		
		if(count($this->rows) == 1) {
			foreach ($this->rows[0] as $propiedad=>$valor) {
				$this->$propiedad = $valor;
				if ($propiedad == "id_user") {
					$_SESSION['id'] = $valor;
				}
				if ($propiedad == "usuario") {
					$_SESSION['usuario'] = $valor;
				}
				if ($propiedad == "correo") {
					$_SESSION['correo'] = $valor;
				}
				if ($propiedad == "clave") {
					$_SESSION['clave'] = $valor;
				}
			}
		} 
		
	}
	
	public function set($user_data=array()) {
		if(array_key_exists('correo', $user_data)){
			$this->get($user_data['correo']); //leemos el usuario por si existe, no crearlo de nuevo
			if($user_data['correo'] != $this->correo){
				foreach ($user_data as $campo=>$valor){
					$$campo = $valor;
				}
					$this->query = "
					INSERT INTO usuarios
					(usuario, correo, clave)
					VALUES
					('$usuario', '$correo', '$clave')
					";
					$this->execute_single_query();
					$this->get_l($user_data);
			}
		}
	}

	public function edit($user_data=array()) {
		foreach ($user_data as $campo=>$valor):
			$$campo = $valor;
		endforeach;
		$this->query = "
			UPDATE usuarios
			SET usuario='$usuario',
			clave='$clave'
			WHERE correo = '$correo'
		";
		$this->execute_single_query();
		$this->mensaje = 'Usuario modificado';
	}

	public function delete($user_email='') {
		$this->query = "
		DELETE FROM usuarios
		WHERE correo = '$user_email'
		";
		$this->execute_single_query();
		$this->mensaje = 'Usuario eliminado';
	}

	function __destruct() {
		//unset($this);
	}

	function __construct() {
		$this->db_name = 'auto_gym';
		
	}
}
?>