<?php require_once('lib/entrenamientos_model.php'); ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<div class="slideshow-container">

	<div class="mySlides fade">
  		<img src="img/slideshow/img1.jpg" class="slide_img" style="width:100%; height: 500px;">
	</div>

	<div class="mySlides fade">
  		<img src="img/slideshow/img2.jpg" class="slide_img" style="width:100%; height: 500px;">
	</div>

	<div class="mySlides fade">
  		<img src="img/slideshow/img3.jpg" class="slide_img" style="width:100%; height: 500px;">
	</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>
<br><br><br>
<div id='opciones'>
  <form method="POST" >
    <input type='submit' name='pecho' class='opcion' value='PECHO'>
    <input type='submit' name='espalda' class='opcion' value='ESPALDA'><br>
    <input type='submit' name='pierna' class='opcion' value='PIERNA'>
    <input type='submit' name='brazo' class='opcion' value='BRAZO'>
  </form>
</div>

<script>

var slide_aux = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slide_aux++;
  if (slide_aux > slides.length) {
  	slide_aux = 1
  }    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slide_aux-1].style.display = "block";  
  dots[slide_aux-1].className += " active";
  setTimeout(showSlides, 3200);
}

function mostrar_opciones(){
  $("#boton_entrenar").hide();
  $("#opciones").show();
}

  $(document).ready(function(){
    $("#opciones").hide();
  });

</script>

<?php 

$entrenamiento = new Entrenamiento();
$grupo = "";
$id_usuario = "";

if (isset($_SESSION['id'])) {
  echo "<div id='boton_entrenar'>
    <input type='button' name='empezar' class='empezar' value='ENTRENAR' onclick='mostrar_opciones()'>
  </div>";
  $id_usuario = $_SESSION['id'];
}else{

  echo "<div id='boton_entrenar'><form action='".$_SERVER['PHP_SELF']."?p=registro' method='POST'>";
  echo "<input type='submit' name='mover_r' class='b_input_r' value='CREA UNA CUENTA'>";
  echo "</form></div>";
}

if (isset($_POST['pecho'])) {
  $grupo = "Pecho";
  $entrenamiento->get_grupo($grupo, $id_usuario);
}

if (isset($_POST['espalda'])) {
  $grupo = "Espalda";
  $entrenamiento->get_grupo($grupo, $id_usuario);
}

if (isset($_POST['pierna'])) {
  $grupo = "Pierna";
  $entrenamiento->get_grupo($grupo, $id_usuario);
}

if (isset($_POST['brazo'])) {
  $grupo = "Brazo";
  $entrenamiento->get_grupo($grupo, $id_usuario);
}

?>


</body>
</html> 
