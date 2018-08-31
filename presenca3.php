<?php
	include "anterior.php";
	include "modelo/banco.php";
	$id = $_GET['idevento'];
	include "verparticipantes.php";
?>
	<form>
	<input type="button" name="imprimir" value="Imprimir" class="btn btn-primary" onclick="window.print();">
	</form>
<?php
	include "posterior.php";
?>