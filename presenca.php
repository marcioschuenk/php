<?php
	include "controle/confereconexao.php";
	$email = $_COOKIE['email'];

	include "modelo/banco.php";
	$atual = time()-60*60*24*2;
	$query = mysqli_query($con, "select * from evento where organizador = '$email' order by datainicio desc");

	include "anterior.php";
	echo "<h1>Meus Eventos</h1>";
	echo "<p>Clique no evento que deseja dar presença.</p>";
	echo "<table class='table'>";
	while($evento = mysqli_fetch_array($query)){
		$idevento = $evento['id'];
		$titulo = $evento['titulo'];
		$cidade = $evento['cidade'];
		
		echo "
		<tr>
			<td><p>$titulo - $cidade </td><td><a href='presenca2.php?idevento=$idevento' class='btn btn-primary btn-xs'>Confirmar presença</a></td><td> <a href='presenca3.php?idevento=$idevento' class='btn btn-primary btn-xs'>Presentes</a></td></p>
		</tr>";

	}

	include "posterior.php";
?>