<?php

	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$senha = md5($senha);

	include "modelo/banco.php";

	$query = mysqli_query($con, "select * from usuario where email = '$email' and senha = '$senha'");

	$ok = 0;

	while($dados = mysqli_fetch_array($query)){
		$ok = 1;
		$email = $dados['email'];
		$nome = $dados['nome'];	
		setcookie("nome", $nome, time()+60*60*8);
		setcookie("email", $email, time()+60*60*8);

	}
	if($ok == 1){
		header("Location:perfil.php");
	}else{
		header("Refresh:5, url=index.php");
		include "anterior.php";
		echo "<p>Usuário ou Senha inválida, você será redirecionado para a página inicial</p>";
		include "posterior.php";
	}



?>