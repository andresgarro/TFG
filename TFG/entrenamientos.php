<?php require_once('lib/entrenamientos_model.php');
require_once('lib/ejercicios_model.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
</head>
<body>

	<div>

  <?php 

  	$entrenamientos;
  	$ejercicios;
  	$ejer_aux = new Ejercicio();
  	$ejer_t;
  	$entr_aux = new Entrenamiento();
  	$id_aux = "";
  	$indice_g = 0;
  	$indice_g2 = 0;
  	$indice_d = 0;
  	$indice_i = 0;
  	$indice_f = 0;
  	$indice_n = 0;
  	$indice_r = 0;
  	$cont_id = 0;

  	if (isset($_SESSION['id']) && !isset($_POST['ver'])) {
  		$id_aux = $_SESSION['id'];
  		$entrenamientos = $entr_aux->get_todos_entrenamientos($id_aux);
  		if (count($entrenamientos) == 0) {
  			echo "<h2 style='text-align: center'>¡¡Todavía no has realizado ningún entrenamiento!!</h2>";
  		}else{
  			echo "<form method='POST'>";
			echo "<table id='t_entr'>";
  			foreach ($entrenamientos as $filas) {
  				foreach ($filas as $indice => $valor) {
  					if ($indice == "grupo_entr" && $indice_g == 0) {
  						echo "<tr>";
  						$indice_g++;
  						echo "<th>";
						echo "Grupo muscular";
						echo "</th>";
  					}
  					if ($indice == "fecha" && $indice_f == 0) {
  						$indice_f++;
  						echo "<th>";
						echo "Fecha";
						echo "</th>";
						echo "<th>";
						echo "Mostrar";
						echo "</th>";
						echo "</tr>";
  					}
  				}
  				foreach ($filas as $indice => $valor) {
  					if ($indice == "grupo_entr" && $indice_g > 0){
  						echo "<tr>";
  						echo "<td>".$valor."</td>";
  					}
  					if ($indice == "fecha" && $indice_f > 0){
  						echo "<td>".$valor."</td>";
  					}
  					if ($indice == "ids_ejer") {
  						echo "<td>"."<form method='POST'><input type='submit' name='ver' id='boton_ver' value='Ver'><input type='hidden' name='id_ejer' value='".$valor."'>"."</form></td>";
  						echo "</tr>";
  					}
  				}
			}
			echo "</table>";
			echo "</form>";
		}
  	}
  	if (!isset($_SESSION['id'])) {
  		echo "<form action='".$_SERVER['PHP_SELF']."?p=registro' method='POST'>";
         echo "<input type='submit' name='mover_r' class='b_input_r' value='Crea una cuenta para acceder'>";
      	echo "</form>";
  	}

  	if (isset($_POST['ver'])) {
  		$ejercicios = $_POST['id_ejer'];
  		$ejer_t = $ejer_aux->get_ejer($ejercicios);
  		echo "<form action='".$_SERVER['PHP_SELF']."' method='POST'>";
			echo "<table id='t_entr'>";
  			foreach ($ejer_t as $filas) {
  				foreach ($filas as $indice => $valor) {
  					if ($indice == "nombre" && $indice_n == 0) {
  						echo "<tr>";
  						$indice_n++;
  						echo "<th>";
						echo "Ejercicio";
						echo "</th>";
  					}
  					if ($indice == "repeticiones" && $indice_r == 0) {
  						$indice_r++;
  						echo "<th style='text-align: center'>";
						echo "Repeticiones";
						echo "</th>";
  					}
  					if ($indice == "grupo" && $indice_g == 0) {
  						$indice_g++;
  						echo "<th class='responsivo'>";
						echo "Grupo muscular";
						echo "</th>";
  					}
  					if ($indice == "dificultad" && $indice_d == 0) {
  						$indice_d++;
  						echo "<th class='responsivo'>";
						echo "Repeticiones";
						echo "</th>";
  					}
  					if ($indice == "images" && $indice_i == 0) {
  						$indice_i++;
  						echo "<th>";
						echo "Ejemplo";
						echo "</th>";
						echo "</tr>";
  					}

  				}
  				foreach ($filas as $indice => $valor) {
  					if ($indice == "nombre" && $indice_n > 0){
  						echo "<tr>";
  						echo "<td>".$valor."</td>";
  					}
  					if ($indice == "repeticiones" && $indice_r > 0){
  						echo "<td>".$valor."</td>";
  					}
  					if ($indice == "grupo" && $indice_g > 0){
  						echo "<td class='responsivo'>".$valor."</td>";
  					}
  					if ($indice == "dificultad" && $indice_d > 0){
  						echo "<td class='responsivo'>".$valor."</td>";
  					}
  					if ($indice == "images") {
  						echo "<td class='ejer_t'><img class='ejer_img' src='".$valor."'></td>";
  					}
  				}
			}
			echo "</table>";
			echo "</form>";
  	}

  ?>

  </div>


</body>
</html> 
