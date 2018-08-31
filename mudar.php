<?php

	if(isset($_GET['id'])){
		include "modelo/banco.php";
		include "controle/confereconexao.php";
		$email = $_COOKIE['email'];
		$query = mysqli_query($con, "update usuario set palestrante = 'sim' where email = '$email'");
		header("Location:perfil.php");

	}
	include "anterior.php";
?>
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Tem certeza que deseja se tornar um palestrante?</h3>
		  	</div>
		  	<div class="panel-body">
		  		<a href="mudar.php?id=sim" class="btn btn-success">Sim</a>
		  		<a href="perfil.php" class="btn btn-danger pull-right">Não</a>
		  	</div>
		</div>

<?php
	include "posterior.php";
?>
