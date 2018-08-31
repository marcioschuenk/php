<?php

	// include "controle/confereconexao.php";

	if(isset($_POST['tipo'])){
		date_default_timezone_set('America/Sao_Paulo');

		$tipo = htmlspecialchars($_POST['tipo']);
		$titulo = htmlspecialchars($_POST['titulo']);
		$tema = htmlspecialchars($_POST['tema']);
		$descricao = htmlspecialchars($_POST['descricao']);
		$vagas = htmlspecialchars($_POST['vagas']);
		$datai = htmlspecialchars($_POST['datai']);
		$horai = htmlspecialchars($_POST['horai']);
		$datainicio = "$datai $horai";
		$timestampinicio = strtotime($datainicio);
		$agora = time();
		$ok = 1;
		if($timestampinicio < $agora){
			header("Location: meuseventos.php");
			$ok = 0;
		}
		$datat = htmlspecialchars($_POST['datat']);
		$horat = htmlspecialchars($_POST['horat']);
		$datatermino = "$datat $horat";
		$timestamptermino = strtotime($datatermino);
		$endereco = htmlspecialchars($_POST['endereco']);
		$telefone = htmlspecialchars($_POST['telefone']);
		$investimento = htmlspecialchars($_POST['investimento']);
		if(empty($_POST['video'])){
			$video = 'nao';
		}else{
			$video = htmlspecialchars($_POST['video']);
		}
		
		$cidade = htmlspecialchars($_POST['cidade']);
		$organizador = $_COOKIE['email'];


			include "modelo/banco.php";

			

		if($ok == 1){	
			if(($tipo == "Feira") or ($tipo == "Congresso")){
				$query = "insert into evento(titulo, tipo, vagas, tema, descricao, palestrante, datainicio, datatermino, endereco, megaevento, organizador, telefone, investimento, video, cidade, arquivo) values ('$titulo', '$tipo', '$vagas', '$tema', '$descricao', 'vazio', '$timestampinicio', '$timestamptermino', '$endereco', 'sim', '$organizador', '$telefone', '$investimento', '$video', '$cidade', 'nao')";
				
				$megaevento = 'sim';
				mysqli_query($con, $query);
				header("Location:meuseventos.php");
			}else{
				$query = "insert into evento(titulo, tipo, vagas, tema, descricao, palestrante, datainicio, datatermino, endereco, megaevento, organizador, telefone, investimento, video, cidade, arquivo) values ('$titulo', '$tipo', '$vagas', '$tema', '$descricao', 'vazio', '$timestampinicio', '$timestamptermino', '$endereco', 'nao', '$organizador', '$telefone', '$investimento', '$video', '$cidade', 'nao')";
				$megaevento = 'nao';
				mysqli_query($con, $query);
				} 
			}
		}
			$pegaid = mysqli_query($con, "select * from evento where organizador = '$organizador' order by id desc");
			if($event = mysqli_fetch_array($pegaid)){
				$id = $event['id'];
	}

	include "anterior.php";
	if($megaevento == 'nao'){
		echo "<p>Deseja chamar um palestrante agora?</p>
				<a class='btn btn-success' href='convidar.php?id=$id'>Sim</a>
				<a class='btn btn-danger' href='meuseventos.php'>Não</a>
			";

	}else{
		header("Location:meuseventos.php");
	}


	include "posterior.php"
	
?>

