<?php
	include "controle/confereconexao.php";
	$email = $_COOKIE['email'];

	include "modelo/banco.php";
	if(empty($_GET['idevento'])){
		header("Location: perfil.php");
	}	
	$idevento = $_GET['idevento'];

	include "anterior.php";

	$query = mysqli_query($con, "select * from evento where id = $idevento"); 

	echo "<form method='post' action='presenca21.php'>";

	while($evento = mysqli_fetch_array($query)){
		$idevento = $evento['id'];
		$titulo = $evento['titulo'];
		$cidade = $evento['cidade'];
	}

	echo "<p> Confirmar presença no evento \"$titulo - $cidade\"</p>";
	echo "<p>Digite o e-mail ou o número de inscrição que está no credenciamento</p>";
	echo "<div class='form-group'>";
	echo "<label>E-mail</label>";
	echo "<input type='text' name='email' class=\"form-control\" />";
	echo "</div>";

	echo "<div class='form-group'>";
	echo "<label>Inscrição</label>";
	echo "<input type='number' name='inscricao' class=\"form-control\" />";
	echo "</div>";

	echo "<input type='hidden' name='idevento' value='$idevento' />";

	echo "<div class='form-group'>";
	echo "<button type=\"submit\" class=\"btn btn-primary\">Confirmar</button>";
	echo "</div>";

	echo "</form>";

	include "posterior.php";
?>