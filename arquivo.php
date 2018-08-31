<?php

	if(empty($_GET['id']) or (empty($_COOKIE['email']))){
		header("Location:perfil.php");
	}
	$email = $_COOKIE['email'];
	$id = $_GET['id'];

	$ok = 0;
	$registro = 0;
	include "modelo/banco.php";
	$query = mysqli_query($con, "select * from evento where id = $id");
	$num = mysqli_num_rows($query);
	$registro = $registro + $num;
	if($num > 0){
		$ev = mysqli_fetch_array($query);
		$email = $ev['organizador'];
	}
	$query = mysqli_query($con, "select * from convite where idevento = $id");
	$num = mysqli_num_rows($query);
	$registro = $registro + $num;
	if($num > 0){
		$ev = mysqli_fetch_array($query);
		$email = $ev['email'];
	}
	include "anterior.php";
	if($registro == 0){
		header("Refresh: 5, perfil.php");
		echo "<p>Você não tem autorização para realizar esta ação!</p>";
	}else{

?>
	<form method="post" action="uploadarquivo.php" enctype="multipart/form-data">
	<h1>Enviar arquivo para o evento</h1>
	  <label>Arquivo</label>
	  <input type="file" name="arquivo" accept=".pdf" />
	  <input type="hidden" name="id" value="<?php echo $id; ?>" />
	  <p>Máximo 10Mb - Extensão PDF apenas</p>
	  <p></p>
	  <button type="submit" class="btn btn-primary">Enviar</button>
	</form>
<?php
	}
	include "posterior.php";
?>

