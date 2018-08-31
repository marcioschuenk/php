<?php
	if(empty($_COOKIE['email']) or empty($_GET['idevento'])){
		header("Location: meuseventos.php");
	}
	$idevento = $_GET['idevento'];

	if(isset($_GET['exc'])){
		$email = $_COOKIE['email'];
		include "modelo/banco.php";
		mysqli_query($con, "delete from participar where idevento=$idevento and emailp='$email'");
		header("Location: perfil.php");

	}
	include "anterior.php";
?>
	<p> Tem certeza que deseja cancelar a sua participação no evento?</p>
	<p>
		<a href="excluirparticipacao.php?idevento=<?php echo $idevento; ?>&exc=s" class="btn btn-danger">Sim</a>
		<a href="perfil.php" class="btn btn-primary pull-right">Não</a>
	</p>
<?php
	include "posterior.php";
?>