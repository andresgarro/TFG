<?php
require_once('db_abstract_model.php');
class Entrenamiento extends DBAbstractModel {
	public $id_user;
	public $grupo_entr;
	public $ids_ejer;
	public $fecha;
	
	public function get_grupo($entr_grupo='', $id_usuario) {
		$aux_ids = "";
		if($entr_grupo != ''):
			$this->query = "
			SELECT id_ejer
			FROM ejercicios
			WHERE grupo = '$entr_grupo'";
			$this->get_results_from_query();
		endif;
		foreach ($this->rows as $indice=>$valor) {
			$aux_ids = $aux_ids.",".implode(",", $valor);
		}
		$this->crear_entrenamientos($aux_ids, $entr_grupo, $id_usuario);

	}

	public function get_todos_entrenamientos($user_id) {
		$id_aux = $user_id;
		$this->query = "
		SELECT grupo_entr, fecha, ids_ejer
		FROM entrenamientos
		WHERE usuario = '$id_aux' ORDER BY id_entr DESC";
		$this->get_results_from_query();
		return $this->rows;
	}

	public function get($user_log=array()) {
		if(array_key_exists('correo', $user_log)){
			$correo_l = $user_log['correo'];
			$clave_l = $user_log['clave'];
			$this->query = "
			SELECT id_user, usuario, correo, clave
			FROM usuarios
			WHERE correo = '$correo_l' AND clave = '$clave_l'";
			$this->get_results_from_query();
		}
	}

	public function set($data=array()) {

				foreach ($data as $campo=>$valor){
					$$campo = $valor;
				}
					$this->query = "
					INSERT INTO entrenamientos
					(usuario, correo, clave)
					VALUES
					('$usuario', '$correo', '$clave')
					";
					$this->execute_single_query();
					$this->mensaje = '*Usuario agregado exitosamente';
	}
	
	public function crear_entrenamientos($aux_ids, $grupo, $id_usuario) {
		$id_aux = trim($aux_ids, ",");
		$fecha_aux = date("F j, Y, g:i a");
		$this->query = "
		INSERT INTO entrenamientos
		(usuario, grupo_entr, ids_ejer, fecha)
		VALUES
		('$id_usuario', '$grupo', '$id_aux', '$fecha_aux')
		";
		$this->execute_single_query();
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