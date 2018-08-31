<?php
	include "modelo/banco.php";
	include "controle/confereconexao.php";
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	$email = $_COOKIE['email'];
	$emailcookie = $email;



	if(isset($_GET['aceitar'])){
		$aceitar = $_GET['aceitar'];
		$idevento = $_GET['evento'];
		if($aceitar == 's'){
			mysqli_query($con, "update convite set status = 'aceito' where idevento = '$idevento'");
		}else{
			mysqli_query($con, "update convite set status = 'recusado' where idevento = '$idevento'");
		}
		header("Location: perfil.php");

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
	include "anterior.php";
?>
	<div class="row">
	<figure class="col-xs-12 col-sm-4 col-md-3 col-lg-2 imgperfil">
		<?php
			
			

			if($foto == 'nao'){
				echo "<img class='img-responsive img-circle ftperfil' src='foto/vazio.png' />";
			}else{
				include "controle/rodaimagem.php";
				image_fix_orientation("foto/$id.jpg");
				echo "<img class='img-responsive ftperfil' src='foto/$id.jpg' />";
			}
		?>
	<figcaption class="">
		<a class="btn" href="trocafoto.php">Alterar Foto</a>
	</figcaption>
	<?php
		$consulta = mysqli_query($con, "select * from convite where email = '$email' and status = 'pendente'");
		$numero = mysqli_num_rows($consulta);
		if($numero > 0){
	?>
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Convite Palestra</h3>
		  	</div>
		  	<div class="panel-body">
		  		<a href="perfilpalestrante.php?id=<?php echo "$id"; ?>">Você tem convite(s) para palestrar. Clique aqui para aceitar ou recusar.</a>
		  	</div>
		</div>

	<?php
		}else{ if($palestrante == 'sim'){
	?>

		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Palestrante</h3>
		  	</div>
		  	<div class="panel-body">
		  		<a href="perfilpalestrante.php?id=<?php echo "$id"; ?>">Veja suas opções de palestrante.</a>
		  	</div>
		</div>
	<?php
				}
		}
		
		$votacao = mysqli_query($con, "select * from votacao where emailpa = '$email'");
		$temvotos = mysqli_num_rows($votacao);
		if($temvotos > 0){
			$votos = 0;
			$pontos = 0;
			while($vot = mysqli_fetch_array($votacao)){
				$pontos = $pontos + $vot['palestrante'];
				$votos++;
			}
			$geral = $pontos/$votos;
		?>
	    	<p class="panel-title">Palestrante </p>
		<div class="nota">
	    <?php
	    	if($geral >0){
	    		echo "<span class='glyphicon glyphicon-star'></span>";
	    	}else{
	    		echo "<span class='glyphicon glyphicon-star-empty'></span>";
	    	}
	    	if($geral >2){
	    		echo "<span class='glyphicon glyphicon-star'></span>";
	    	}else{
	    		echo "<span class='glyphicon glyphicon-star-empty'></span>";
	    	}
	    	if($geral >4){
	    		echo "<span class='glyphicon glyphicon-star'></span>";
	    	}else{
	    		echo "<span class='glyphicon glyphicon-star-empty'></span>";
	    	}
	    	if($geral >6){
	    		echo "<span class='glyphicon glyphicon-star'></span>";
	    	}else{
	    		echo "<span class='glyphicon glyphicon-star-empty'></span>";
	    	}
	    	if($geral >8){
	    		echo "<span class='glyphicon glyphicon-star'></span>";
	    	}else{
	    		echo "<span class='glyphicon glyphicon-star-empty'></span>";
	    	}
	    	$geral = number_format($geral, 1, ',','.');
		echo "<p>Votos: $votos</p><p>Média: $geral</p></div>";
		}
	?>  	
	</figure>

	<section class="col-xs-12 col-sm-8 col-md-6 col-lg-7">
	<?php



		if(isset($_SESSION['idevento'])){
		?>
			<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
			  Participação Pendente
			</a>
			<div class="collapse" id="collapseExample">
			  <div class="well">
			    <p>Você tem uma participação pendente. <a href="participar.php">Clique aqui</a> para confirmar presença ou recusar participação.</p>
			  </div>
			</div>
			
		<?php
			}
		?><p></p>
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title"><?php echo "$nome";?></h3>
		  	</div>
		  	<div class="panel-body">
		  	  <?php echo "	<p>E-mail: $email</p>
		  	  				<p>Telefone: ($ddd) $telefone</p>
		  	  				";?>
		  	</div>
		  	<div class="panel-footer">
		  	  <a href="editar.php" class="btn btn-danger">Editar Perfil</a>
		  	  <?php
		  	  	if($palestrante == "nao"){
		  	  		?>
		  	  		<a href="mudar.php" class="btn btn-primary pull-right">Seja um palestrante</a>
		  	  		<?php
		  	  	}else{
		  	  		?>
		  	  		<a href="perfilpalestrante.php?id=<?php echo $id;?>" class="btn btn-primary pull-right">Perfil Palestrante</a>
		  	  		<?php
		  	  	}
		  	  ?>
		  	</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Eventos que fiz inscrição</h3>
		  	</div>
		  	<div class="panel-body">
		  	  <?php 
		  	  		$atual = time();
		  	  		$consulta = mysqli_query($con, "select p.*, e.* from participar p, evento e where e.id = p.idevento and p.emailp = '$email' and datainicio > $atual order by datainicio");
		  	  		$totevento = mysqli_num_rows($consulta);
		  	  		if($totevento == 0){
		  	  			echo "<p>Você não está inscrito para nenhum evento futuro.</p>";
		  	  		}else{
		  	  			while($e = mysqli_fetch_array($consulta)){
		  	  				$titulo = $e['titulo'];
		  	  				$arquivo = $e['arquivo'];
		  	  				$idevento = $e['idevento'];
		  	  				$datainicio = $e['datainicio'];
		  	  				$inicio = date("d/m/Y H:i", $datainicio);
		  	  				$datatermino = $e['datatermino'];
		  	  				$fim = date("d/m/Y H:i", $datatermino);
		  	  				echo "<p>$titulo - De: $inicio até $fim </p><p> <a href='cracha.php?id=$idevento' target='_blank' class='btn btn-primary btn-sm'>Credencial <span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span></a> <a href='excluirparticipacao.php?idevento=$idevento' class='btn btn-danger btn-sm'> Desistir</a>";
		  	  				$baixar = mysqli_query($con, "select * from participar where idevento=$idevento and emailp = '$emailcookie'");
		  	  				if($a = mysqli_fetch_assoc($baixar)){
		  	  					if($arquivo != 'nao'){
		  	  						echo " <a href='arquivo/$arquivo' class='btn btn-danger btn-sm'>Arquivo <span class='glyphicon glyphicon-file'></span></a> ";
		  	  					}
		  	  				}


		  	  				echo " </p>";
		  	  			}
		  	  		}


		  	  ?>
		  	</div>
		  	
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Eventos que participei</h3>
		  	</div>
		  	<div class="panel-body">
		  	  <?php 
		  	  		$atual = time();
		  	  		$consulta = mysqli_query($con, "select p.*, e.* from participar p, evento e where e.id = p.idevento and p.emailp = '$email' and datainicio < $atual and p.presente = 1 order by datainicio desc limit 5");
		  	  		$totevento = mysqli_num_rows($consulta);
		  	  		if($totevento == 0){
		  	  			echo "<p>Você não participou de nenhum evento</p>";
		  	  		}else{
		  	  			while($e = mysqli_fetch_array($consulta)){
		  	  				$titulo = $e['titulo'];
		  	  				$idevento = $e['idevento'];
		  	  				$datainicio = $e['datainicio'];
		  	  				$inicio = date("d/m/Y", $datainicio);
		  	  				$datatermino = $e['datatermino'];
		  	  				$voto = $e['voto'];
		  	  				$arquivo = $e['arquivo'];
		  	  				$fim = date("d/m/Y H:i", $datatermino);
		  	  				echo "<p>$titulo - Dia: $inicio</p><p>";
		  	  				if($voto == 0){
		  	  					echo "<a class='btn btn-warning btn-sm' href='votar.php?id=$idevento'>Avaliar</a> ";
		  	  				}
		  	  				echo "<a  class='btn btn-warning btn-sm' href='certificado.php?id=$idevento' target='_blank'>Certificado </a>";
		  	  				$baixar = mysqli_query($con, "select * from participar where idevento=$idevento and emailp = '$emailcookie'");
		  	  				if($a = mysqli_fetch_assoc($baixar)){
		  	  					if($arquivo != 'nao'){
		  	  						echo " <a href='arquivo/$arquivo' class='btn btn-danger btn-sm'>Arquivo <span class='glyphicon glyphicon-file'></span></a> ";
		  	  					}
		  	  				}
		  	  				echo "</p><hr />";
		  	  				
		  	  			}
		  	  		}


		  	  ?>
		  	</div>
		  	
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Eventos que não compareci</h3>
		  	</div>
		  	<div class="panel-body">
		  	  <?php 
		  	  		$atual = time();
		  	  		$consulta = mysqli_query($con, "select p.*, e.* from participar p, evento e where e.id = p.idevento and p.emailp = '$email' and datainicio < $atual and p.presente = 0 order by datainicio");
		  	  		$totevento = mysqli_num_rows($consulta);
		  	  		if($totevento == 0){
		  	  			echo "<p>Você não  faltou nenhum evento</p>";
		  	  		}else{
		  	  			while($e = mysqli_fetch_array($consulta)){
		  	  				$titulo = $e['titulo'];
		  	  				$idevento = $e['idevento'];
		  	  				$datainicio = $e['datainicio'];
		  	  				$inicio = date("d/m/Y H:i", $datainicio);
		  	  				$datatermino = $e['datatermino'];
		  	  				$fim = date("d/m/Y H:i", $datatermino);
		  	  				echo "<p>$titulo - De: $inicio até $fim</p>";
		  	  			}
		  	  		}


		  	  ?>
		  	</div>
		  	
		</div>
	</section>
	<section class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Meus Eventos Criados</h3>
		  	</div>
		  	<div class="panel-body">
		  		<?php
		  			$query2 = mysqli_query($con, "select * from evento where organizador = '$email'");
		  			$numero = mysqli_num_rows($query2);
		  			if($numero == 0){
		  		?>
			  		<p>Você não criou nenhum evento.</p>
			  		
			  		<p><a href="novoevento.php" class="btn btn-danger"> Criar Evento</a></p>
			  	<?php
			  		}else{
			  			$query3 = mysqli_query($con, "select * from evento where organizador = '$email' order by datainicio desc");
			  			if($evento = mysqli_fetch_assoc($query3)){
			  				$titulo = $evento['titulo'];
			  			}

			  		echo "<p>$titulo</p>";
			  		?>
			  		
			  		<p><a href="meuseventos.php" class="btn btn-info"> Ver Todos</a>	
			  		<a href="novoevento.php" class="btn btn-danger"> Criar Evento</a></p>
			  	<?php
			  		}
			  	?>
		  	</div>
		 </div>
		 <?php
		 	if($numero > 0){
		 ?>
		 <div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Presença</h3>
		  	</div>
		  	<div class="panel-body">
		  		<p><a href="presenca.php"> Clique aqui para dar presença e verificar as pessoas presentes no seu evento</a> </p>
		  	</div>
		 </div>
		 <?php
		 	}
		 ?>
	</section>
	
	</div>
<?php
	include "posterior.php";
?>