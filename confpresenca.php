<?php
	if(empty($_COOKIE['email']) or empty($_GET['idevento']) or empty($_GET['e'])){
		header("Location:perfil.php");
	}
	include "modelo/banco.php";
	$idevento = $_GET['idevento'];
	$e = $_GET['e'];
	$email = $_COOKIE['email'];
	$query = mysqli_query($con, "select * from evento where id = $idevento");
	$atual = time()+7200;
	while($evento = mysqli_fetch_array($query)){
		$datainicio = $evento['datainicio'];
		$emailevento = $evento['organizador'];
	}
	if($email <> $emailevento){
		header("Refresh:5,perfil.php");
		include "anterior.php";
		echo "<p>Somente o organizador do evento pode dar presença no evento.</p>";
	}else{
		include "anterior.php";
		if($atual < $datainicio){
			echo "<p>As incrições só abrem duas horas antes do evento.</p>";
		}else{
			mysqli_query($con, "update participar set presente = 1 where idevento = '$idevento' and emailp = '$e'");
			echo "<p>Participação Confirmada</p>";
			header("Refresh:5,perfil.php");
		}
	}

?>