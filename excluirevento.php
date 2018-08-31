<?php
	include "modelo/banco.php";
	include "controle/confereconexao.php";
	if(empty($_GET['id'])){
		header("Location:perfil.php");
	}
	$id = $_GET['id'];

	mysqli_query($con, "delete from evento where id = $id");
	mysqli_query($con, "delete from convite where idevento = $id");

	header("Refresh:5, meuseventos.php");
	include "anterior.php";
	echo "<p>Seu evento foi cancelado com sucesso.</p>";
	include "posterior.php";
?>