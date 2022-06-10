<?php require_once('lib/usuarios_model.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script type="text/javascript">

	$(document).ready(function(){
		$("#grid-login").hide();
		$("#mensaje_error").hide();
		$("#boton_r").hide();
		$("#mensaje").hide();
	});
	
	function comprobar(){

		var formulario_aux = document.registro;
		var usuario_aux = formulario_aux.usuario.value;
		var email_aux = formulario_aux.correo.value;
		var exp_reg_email = /^[A-Za-z0-9+_.-]+@(.+)$/;
		var pass_aux = formulario_aux.contraseña.value;
		var exp_reg_pass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
		if (!exp_reg_email.test(email_aux) || !exp_reg_pass.test(pass_aux) || usuario_aux == " ") {
			$("#mensaje_error").show();
		}else{
			$("#boton").hide();
			$("#boton_r").show();
			$("#mensaje_error").hide();
			$("#mensaje").show();
			$("#contraseña").attr("readonly", true);
			$("#usuario").attr("readonly", true);
			$("#correo").attr("readonly", true);
		}
						
	}

	function mostrar_l(){

		$("#boton_m_l").hide();
		$("#grid-login").show();
		$("#grid-registro").hide();

	}

	function recarga(){
		window.location.reload();
	}

</script>

</head>

<body>

	<?php
	if (isset($_SESSION['id'])) {
		echo "<div id='grid-log_out'>
			<form method='POST' id='login' name='login' onsubmit='setTimeout(function(){window.location.reload();},10);'>
			Correo registrado:
			<input type='text' class='r_input' name='usuario_l' id='usuario_l' value=".$_SESSION['correo']." readonly><br><br>
			Usuario:
			<input type='text' class='r_input' name='nombre_l' id='nombre_l' value=".$_SESSION['usuario']." readonly><br><br><br>
			<input type='submit' class='b_input' name='boton_l_o' id='boton_l_o' value='Log out' onclick='func_logout()'>
		</form>
	</div>";
	}else{
	echo "<div id='grid-registro'>
		<form method='POST' id='registro' name='registro' onsubmit='setTimeout(function(){window.location.reload();},10);'>
			Nombre de Usuario:
			<input type='text' class='r_input' name='usuario' id='usuario'><br><br>
			Correo electrónico:
			<input type='text' class='r_input' name='correo' id='correo'><br><br>
			Contraseña:
			<input type='password' class='r_input' name='contraseña' id='contraseña'><br><br><br>
			<input type='button' class='b_input' name='boton' id='boton' value='Validar' onclick='comprobar()'>
			<input type='submit' class='b_input' name='boton_r' id='boton_r' value='Registrar'>
			<br>
			<input type='button' class='b_input' name='boton_m_l' id='boton_m_l' value='Ya estoy registrado' onclick='mostrar_l()'>
			<br><br><div id='mensaje_error' name='mensaje_error' style='color: red;'>*Formato de usuario, correo o contraseña incorrecto. (La contraseña debe tener mínimo 8 carácteres, una mayúscula y un dígito.)</div>
			<div id='mensaje' name='mensaje' style='color: green;'>*Formato de datos correcto.</div>
		</form>
	</div>

	<div id='grid-login'>
		<form method='POST' id='login' name='login' onsubmit='setTimeout(function(){window.location.reload();},10);'>
			Correo registrado:
			<input type='text' class='r_input' name='usuario_l' id='usuario_l'><br><br>
			Contraseña:
			<input type='password' class='r_input' name='contraseña_l' id='contraseña_l'><br><br><br>
			<input type='submit' class='b_input' name='boton_l' id='boton_l' value='Log in'>
			<br><br><div id='mensaje_error' name='mensaje_error' style='color: red;'></div>
		</form>
	</div>";
	}
	?>

	<?php
	$usuario = "";
	$correo = "";
	$contraseña = "";

	if (isset($_POST['boton_r'])) {
		$usuario = $_POST['usuario'];
		$correo = $_POST['correo'];
		$contraseña = $_POST['contraseña'];
		$new_user_data = array(
		'usuario'=>$usuario,
		'correo'=>$correo,
		'clave'=>$contraseña
		);
		$usuario_aux = new Usuario();
		$usuario_aux->set($new_user_data);
		
	}

	if (isset($_POST['boton_l'])) {
		if (isset($_POST['usuario_l']) && isset($_POST['contraseña_l'])) {
			$correo = $_POST['usuario_l'];
			$contraseña = $_POST['contraseña_l'];
			$user_log_data = array(
				'correo'=>$correo,
				'clave'=>$contraseña
			);
			$usuario_aux = new Usuario();
			$usuario_aux->get_l($user_log_data);
			
		}else{
			echo "*Por favor rellene los datos.";
		}
	}

	if (isset($_POST['boton_l_o'])) {
		session_destroy();
		
	}

?>

</body>

</html> 
