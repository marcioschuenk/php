<?php
	if(empty($_POST['email'])){
		header("Location:perfil.php");
	}
	include "controle/confereconexao.php";
	include "modelo/banco.php";

	$idevento = $_POST['idevento'];
	$email = $_POST['email'];
	$emailpa = $_POST['emailpa'];
	$estrutura = $_POST['estrutura'];
	$organizacao = $_POST['organizacao'];
	$palestrante = $_POST['palestrante'];
	$comentario = $_POST['comentario'];

	mysqli_query($con, "update participar set voto=1 where emailp = '$email' and idevento = '$idevento'");
	mysqli_query($con, "insert into votacao(idevento, estrutura, organizacao, palestrante, emailpa, comentario, autorizado) values('$idevento', '$estrutura', '$organizacao', '$palestrante', '$emailpa', '$comentario', 'nao')");

	include "anterior.php";
	echo "<p> Voto registrado com sucesso, você será redirecionado para o seu perfil.</p>";
	header("Refresh:5, perfil.php");
	include "posterior.php";
?>