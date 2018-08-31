<?php
	$nome = htmlspecialchars($_POST['nome']);
	$cpf = htmlspecialchars($_POST['cpf']);
	$cidade = htmlspecialchars($_POST['cidade']);
	$estado = htmlspecialchars($_POST['estado']);
	$estado = strtoupper($estado);
	$sexo = htmlspecialchars($_POST['sexo']);
	$ddd = htmlspecialchars($_POST['ddd']);
	$telefone = htmlspecialchars($_POST['telefone']);
	$email = htmlspecialchars($_POST['email']);
	$senha = htmlspecialchars($_POST['senha']);
	$senha = md5($senha);


	include "modelo/banco.php";

	$query = "insert into usuario(nome, cpf, email, senha, ddd, telefone, cidade, estado, sexo, palestrante, foto) values ('$nome', '$cpf', '$email', '$senha', '$ddd', '$telefone', '$cidade', '$estado', '$sexo', 'nao', 'nao')";

	mysqli_query($con, $query);

	setcookie("nome", $nome, time()+60*60*2);
	setcookie("email", $email, time()+60*60*2);

	header("Location:perfil.php");
?>