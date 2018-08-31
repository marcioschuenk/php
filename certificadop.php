<?php
	if(empty($_COOKIE['email'])){
		header("Location:perfil.php");
	}
	if(empty($_GET['id'])){
		header("Location: perfil.php");
	}
	include "modelo/banco.php";
	$idevento = $_GET['id'];
	$query = mysqli_query($con, "select * from evento where id = '$idevento'");
	while($ev = mysqli_fetch_array($query)){
		$tipo = $ev['tipo'];
		$titulo = $ev['titulo'];
		$cidade = $ev['cidade'];
		$data = $ev['datainicio'];
		$dia = date("d", $data);
		$mess = date("m", $data);
		$ano = date("Y", $data);
		switch ($mess) {
       		case "01":    $mes = 'Janeiro';     break;
        	case "02":    $mes = 'Fevereiro';   break;
        	case "03":    $mes = 'Março';       break;
        	case "04":    $mes = 'Abril';       break;
        	case "05":    $mes = 'Maio';        break;
        	case "06":    $mes = 'Junho';       break;
        	case "07":    $mes = 'Julho';       break;
        	case "08":    $mes = 'Agosto';      break;
        	case "09":    $mes = 'Setembro';    break;
        	case "10":    $mes = 'Outubro';     break;
        	case "11":    $mes = 'Novembro';    break;
        	case "12":    $mes = 'Dezembro';    break; 
		}
	}
 	$nome = $_COOKIE['nome'];
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<title>Panelist.com.br - A rede das palestras</title>
		<style>
			body{
				margin: 0px;
				padding: 0px;
			}
			.cert{	
				width: 1122px;
				height: 750px;
				border: solid 1px #000;
				background-image: url("imagem/certificate.png");
				background-size: 1122px 750px;	
				font-family: Monotype Corsiva;
			}
			h1{
				padding:70px 80px;
				font-size: 50px;
			}
			.texto{
				padding:50px 75px;
				font-size: 40px;
			}
			.texto2{
				padding:80px 75px;
				font-size: 20px;
				text-align: center;
			}
			.titulo{
				margin:0 auto;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="cert">
			<div class="titulo"><h1>CERTIFICADO</h1></div>

		<p class="texto">O Site www.paneslist.com.br, certifica que <?php echo "$nome"; ?>, Ministrou o(a) <?php echo "$tipo $titulo"; ?> no dia <?php echo "$dia de $mes de $ano"; ?>.</p>
		
		<p class="texto2"><?php echo "$cidade, $dia de $mes de $ano"; ?></p>
		<p class="texto2">www.paneslist.com.br</p>
		
		</div>
	</body>
</html>