<?php
	date_default_timezone_set('America/Sao_Paulo');
	if(empty($_POST['idevento'])){
		//header("Location: perfil.php");
	}
	if(empty($_COOKIE['email'])){
		header("Location: perfil.php");
	}

	$idevento = $_POST['idevento'];
	include "modelo/banco.php";

	$verificar = mysqli_query($con, "select * from evento where id = $idevento");
	while($e = mysqli_fetch_array($verificar)){
		$email = $_COOKIE['email'];
		$organizador = $e['organizador'];
		if($email != $organizador){
			header("Location: perfil.php");
		}
	}

	
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		mysqli_query($con, "update participar set presente = 1 where emailp = '$email'");
	}
	if(isset($_POST['inscricao'])){
		$inscricao = $_POST['inscricao'];
		mysqli_query($con, "update participar set presente = 1 where idparticipar = '$inscricao'");
		$is = mysqli_query($con, "select * from participar where idparticipar = '$inscricao'");
		while($row = mysqli_fetch_array($is)){
			$email = $row['emailp'];
		}
	}



	$query = mysqli_query($con, "select * from usuario where email = '$email'");
	if($dados = mysqli_fetch_assoc($query)){
		$nome = $dados['nome'];  
		$foto = $dados['foto'];  
		$id = $dados['id']; 
		$ddd = $dados['ddd'];
		$telefone = $dados['telefone'];
		$palestrante = $dados['palestrante'];  
	}
	$query = mysqli_query($con, "select * from evento where id = '$idevento'");
	while($evento = mysqli_fetch_array($query)){
		$titulo = $evento['titulo'];
		$datainicio = $evento['datainicio'];
		$inicio = date("d/m/Y H:i", $datainicio);
		$local = $evento['endereco'];
	}


	?>
	<html>
		<head>
			<link rel="stylesheet" type="text/css" href="css/estilo.css" />
			

		</head>
	<body>
	<?php 
	$inc = mysqli_query($con, "select * from participar where emailp = '$email' and idevento = '$idevento'");
	$row = mysqli_fetch_array($inc);
	$idi = $row['idparticipar'];
	?>
	<div class="cracha">
	<figure class="col-xs-12 col-sm-4 col-md-3 col-lg-2 imgperfil">
		<?php
			
		echo "<p>$nome</p>";
		echo "<p>($email)</p>";
		echo "<p>Incrição: $idi</p>";
			

			if($foto == 'nao'){
				echo "<img class='ftperfil' src='foto/vazio.png' />";
			}else{
				echo "<p><img class='ftperfil' src='foto/$id.jpg' /></p>";
	
			}
				echo "<p>$titulo</p>";
				echo "<p>$inicio</p>";
				echo "<p>$local</p>";
	include('phpqrcode/qrlib.php');
	QRcode::png("http://www.panelist.com.br/confpresenca.php?idevento=$idevento&e=$email", "QR_code.png");
	?>
	<img src="QR_code.png">
	</figure>
	</div>
	<a href="presenca2.php?idevento=<?php echo $idevento; ?>" class="btn btn-primary">Voltar</a>
	<p></p><p><form>
	<input type="button" name="imprimir" value="Imprimir" onclick="window.print();">
	</form></p>
<?php
	include "posterior.php";
?>