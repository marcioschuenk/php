<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$email = $_GET['email'];

		include "modelo/banco.php";
		$query = mysqli_query($con, "select * from convite where idevento = $id");
		$numero = mysqli_num_rows($query);
		if($numero == 0){
			mysqli_query($con, "insert into convite(idevento, email, status) 
					values('$id', '$email', 'pendente')");
		}else{
			mysqli_query($con, "update convite set email = '$email', status = 'pendente' where idevento='$id'");
		}

		header("Location:enviaconvite.php");
	}else{
		header("Refresh:5,meuseventos.php");
		include "anterior.php";
			echo "<p>O Convite já foi enviado com sucesso! Aguarde a resposta.</p>";
		include "posterior.php";
	}
?>
