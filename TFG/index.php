   <?php session_start(); ?>
   <?php
	$p="inicio";
	if(isset($_GET['p'])){
		$p=$_GET['p'];
	}
	if($p=="inicio"){
		$pagina="inicio.php";
	}
	if($p=="entr"){
		$pagina="entrenamientos.php";
	}
	if($p=="registro"){
		$pagina="registro.php";
	}
	
	require("cabecera.php");
   ?>

   <div class="holder_content">
      <section class="group1">
		 
		 <?php
			include($pagina);
		 ?>
           
       </section>
	</div>
	<?php
		require_once("pie.php")
   ?>