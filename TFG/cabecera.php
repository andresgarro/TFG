<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Auto-Gym</title>
<link rel="icon" href="images/favicon.gif" type="image/x-icon"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
<link rel="shortcut icon" href="images/favicon.gif" type="image/x-icon"/> 
<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
<link href="css/fontawesome-free-5.15.4-web/css/all.css" rel="stylesheet">
</head>
<header>
<a href="index.php" id="logo"><img src="img/logo/logo.jpg" width="180" height="80" alt="logo"/></a>
<input type="checkbox" id="hamburguesa">
<label for="hamburguesa" class="fa fa-bars" id="icono"></label>
   <ul class="menu">
      <li <?php if($p=='inicio') echo 'class="current"' ?>><a href="index.php?p=inicio">INICIO</a></li>
      <li <?php if($p=='entr') echo 'class="current"' ?>><a href="index.php?p=entr">ENTRENAMIENTOS</a></li>

      <?php 
         if (isset($_SESSION['id'])) {
            echo "<li id='boton-registro'";
            if($p=='registro') echo 'class="current"';
            echo "><a href='index.php?p=registro'>LOG OUT</a></li>";
         }else{
            echo "<li id='boton-registro'";
            if($p=='registro') echo 'class="current"';
            echo "><a href='index.php?p=registro'>IDENTIFÍCATE</a></li>";
         }
      ?>

   </ul>
</header>
<br><br>

   <section id="intro">
      <hgroup>
      <h1 id="auto-gym"><i class="fas fa-dumbbell"></i> AUTO-GYM <i class="fas fa-dumbbell"></i></h1>
     
      <h2> </h2>
      </hgroup>
   </section>
