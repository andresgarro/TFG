<?php
require_once('db_abstract_model.php');
class Ejercicio extends DBAbstractModel {
	public $nombre;
	public $repeticiones;
	public $grupo;
	public $dificultad;
	public $id_ejer;
	
	public function get($grupo_entr='') {
		if($grupo_entr != ''):
			$this->query = "
			SELECT id_ejer
			FROM ejercicios
			WHERE grupo = '$grupo_entr'";
		
			$this->get_results_from_query();
		endif;
		
		if(count($this->rows) == 1) {
			foreach ($this->rows[0] as $propiedad=>$valor) {
				$this->$propiedad = $valor;
			}
			$this->mensaje = '*ejercicio encontrado';
		} else {
			$this->mensaje = '*ejercicio no encontrado';
		}
		
	}

	public function get_ejer($id_entr_aux='') {
		if($id_entr_aux != ''):
			$this->query = "
			SELECT nombre, repeticiones, grupo, dificultad, images
			FROM ejercicios
			WHERE id_ejer IN ($id_entr_aux)";
			$this->get_results_from_query();
			return $this->rows;
		endif;
	}
	
	public function set($user_data=array()) {
		if(array_key_exists('grupo', $user_data)){
			$this->get($user_data['grupo']); //leemos el nombre por si existe, no crearlo de nuevo
			if($user_data['grupo'] != $this->grupo){
				foreach ($user_data as $campo=>$valor){
					$$campo = $valor;
				}
					$this->query = "
					INSERT INTO ejercicios
					(nombre, repeticiones, grupo, dificultad)
					VALUES
					('$nombre', '$repeticiones', '$grupo', '$dificultad')
					";
					$this->execute_single_query();
					$this->mensaje = '*nombre agregado exitosamente';
					$this->get_l($user_data);
			} else {
				$this->mensaje = '*El ejercicio ya existe.';
			}
		} else {
			$this->mensaje = '*No se ha agregado al ejercicio';
		}
		echo "<p style='color: red'>".$this->mensaje."</p>";
	}

	public function edit($user_data=array()) {
		foreach ($user_data as $campo=>$valor):
			$$campo = $valor;
		endforeach;
		$this->query = "
			UPDATE ejercicios
			SET nombre='$nombre',
			repeticiones='$repeticiones',
			dificultad='$dificultad'
			WHERE grupo = '$grupo'
		";
		$this->execute_single_query();
		$this->mensaje = 'ejercicio modificado';
	}

	public function delete($grupo_entr='') {
		$this->query = "
		DELETE FROM ejercicios
		WHERE grupo = '$grupo_entr'
		";
		$this->execute_single_query();
		$this->mensaje = 'ejercicio eliminado';
	}

	function __destruct() {
		//unset($this);
	}

	function __construct() {
		$this->db_name = 'auto_gym';
		
	}
}
?>