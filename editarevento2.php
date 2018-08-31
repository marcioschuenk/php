<?php
		if(isset($_POST['titulo'])){
			date_default_timezone_set('America/Sao_Paulo');

			$titulo = htmlspecialchars($_POST['titulo']);
			$tema = htmlspecialchars($_POST['tema']);
			$descricao = htmlspecialchars($_POST['descricao']);
			$vagas = htmlspecialchars($_POST['vagas']);
			$datai = htmlspecialchars($_POST['datai']);
			$horai = htmlspecialchars($_POST['horai']);
			$datainicio = "$datai $horai";
			$timestampinicio = strtotime($datainicio);
			$datat = htmlspecialchars($_POST['datat']);
			$horat = htmlspecialchars($_POST['horat']);
			$datatermino = "$datat $horat";
			$timestamptermino = strtotime($datatermino);
			$endereco = htmlspecialchars($_POST['endereco']);
			$telefone = htmlspecialchars($_POST['telefone']);
			$organizador = $_COOKIE['email'];
			$id = $_POST['id'];
			if(empty($_POST['video'])){
				$video = 'nao';
			}else{
				$video = htmlspecialchars($_POST['video']);
			}
			$investimento = htmlspecialchars($_POST['investimento']);
			$cidade = htmlspecialchars($_POST['cidade']);
			include "modelo/banco.php";

			

			

			$query = "update evento set titulo = '$titulo', vagas = $vagas, tema = '$tema', descricao = 'descricao', datainicio = '$timestampinicio', datatermino = '$timestamptermino', endereco = '$endereco',  telefone = '$telefone', investimento = '$investimento', cidade = '$cidade' where id = $id";
			

			mysqli_query($con, $query);
			header("Location:meuseventos.php");
	
		}
?>