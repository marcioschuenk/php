<?php
	include "modelo/banco.php";
	$meu = 0;
	if(isset($_GET['idvotacao']) and isset($_GET['aceitar'])){
		$idvotacao = $_GET['idvotacao'];
		$aceitar = $_GET['aceitar'];
		if($aceitar == 's'){
			mysqli_query($con, "update votacao set autorizado = 'sim' where id = $idvotacao");
		}else{
			mysqli_query($con, "update votacao set autorizado = 'nunca' where id = $idvotacao");
		}
		header("Location:perfil.php");
	}
	if(empty($_GET['id'])){
		header("Location:index.php");
	}
	if(isset($_COOKIE['email'])){
		$emailcookie = $_COOKIE['email'];
	}
	date_default_timezone_set('America/Sao_Paulo');
	$id = $_GET['id'];
	$idpalestrante = $_GET['id'];
	$query = mysqli_query($con, "select * from usuario where id = '$id'");

	if($dados = mysqli_fetch_assoc($query)){
		$nome = $dados['nome'];  
		$curriculo = $dados['curriculo'];
		$foto = $dados['foto'];  
		$email = $dados['email'];  
		$ddd = $dados['ddd'];
		$telefone = $dados['telefone'];
		$palestrante = $dados['palestrante'];  
		
		if($palestrante == 'nao'){
			header("Location:index.php");
		}

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
		<p><?php echo $nome; ?></p>
	</figcaption>
	<?php 
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
		echo "</div>";
		}
	?>  	


	</figure>
	<section class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
		<h1>Palestrante <?php echo $nome; ?></h1>

		<!-- parte dos convites -->

		<?php
			if(isset($_COOKIE['email'])){
				$emailc = $_COOKIE['email'];
				$meu = 0;
				if($email == $emailc){
					$meu = 1;
					$convites = mysqli_query($con, "select * from convite where email = '$email' and status = 'pendente'");
					while($convite = mysqli_fetch_array($convites)){
						$idevento = $convite['idevento']; 
						$eventos = mysqli_query($con, "select * from evento where id=$idevento");
						if($evento = mysqli_fetch_assoc($eventos)){
							$titulo = $evento['titulo'];
							$tipo = $evento['tipo'];
							$datainicio = $evento['datainicio'];
							$datatermino = $evento['datatermino'];
							$endereco = $evento['endereco'];
							$organizador = $evento['organizador'];
							$dia = date('d/m/Y', $datainicio);
							$hora = date('H:i', $datainicio);
							$horater = date('H:i', $datatermino);

							echo "<div class=\"panel panel-danger\">
								<div class=\"panel-heading\">
							    	<h3 class=\"panel-title\">Convite para $tipo</h3>
							  	</div>
							  	<div class=\"panel-body\">
							  		<p>Título: $titulo</p>
							  		<p>Data: $dia de $hora até $horater</p>
							  		<p>Endereço: $endereco</p>
							  		<p>E-mail da Organização: $organizador</p>
							  		<a href='perfil.php?aceitar=s&evento=$idevento' class='btn btn-primary'>Aceitar</a>
							  		<a href='perfil.php?aceitar=n&evento=$idevento' class='btn btn-danger'>Recusar</a>
							  		<a href='evento.php?idevento=$idevento' class='btn btn-info'>+ Info</a>
							  	</div>
							  	</div>
							";
						}


					}
				}
			}

			// Agora, aceitar ou não depoimentos

			
			if(isset($_COOKIE['email'])){
				$emailc = $_COOKIE['email'];
				$meu = 0;
				if($email == $emailc){
					$meu = 1;
					$votacao = mysqli_query($con, "select * from votacao where emailpa = '$email' and autorizado = 'nao'");
					while($depoimento = mysqli_fetch_array($votacao)){
						$comentario = $depoimento['comentario'];
						$idvotacao = $depoimento['id'];
						
							echo "<div class=\"panel panel-danger\">
								<div class=\"panel-heading\">
							    	<h3 class=\"panel-title\">Depoimento</h3>
							  	</div>
							  	<div class=\"panel-body\">
							  		<p>Comentário: $comentario</p>

							  		<a href='perfilpalestrante.php?aceitar=s&idvotacao=$idvotacao' class='btn btn-primary'>Aceitar</a>
							  		<a href='perfilpalestrante.php?aceitar=n&idvotacao=$idvotacao' class='btn btn-danger'>Recusar</a>
							  		
							  	</div>
							  	</div>
							";
						


					}
				}
			}
		
			if($curriculo != null){
			?>
				<div class="panel panel-primary">
					<div class="panel-heading">
		    			<h3 class="panel-title">Sobre <?php echo $nome; ?></h3>
		  			</div>
		  			<div class="panel-body">
		  			<?php

		  				echo $curriculo;

				  			
		  			?>
		  			</div>
		  		</div>
			<?php
			}
				if($meu == 1){
					echo "<p><a href='editarcurriculo.php' class='btn btn-primary'>Editar Currículo</a></p>";
				}

		?>
		
		


		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Próximas Palestras</h3>
		  	</div>
		  	<div class="panel-body">
		  	  <?php 
		  	  	$atual = time();
		  	  	$ver = mysqli_query($con, "select e.*, c.* from evento e, convite c where e.datainicio > $atual and c.status = 'aceito' and e.id = c.idevento and c.email = '$email' order by datainicio");
		  	  	$pal = mysqli_num_rows($ver);
		  	  	if($pal==0){
		  	  		echo "<p>Sem palestras futuras no momento</p>";
		  	  	}else{
		  	  		echo "<table class='table'>
		  	  				<tr>
		  	  					<th>Evento</th>
		  	  				</tr>
		  	  			";
		  	  			while($evento = mysqli_fetch_array($ver)){
		  	  				$titulo = $evento['titulo'];
		  	  				$emailconvite = $evento['email'];
		  	  				$tipo = $evento['tipo'];
		  	  				$data = $evento['datainicio'];
		  	  				$idevento = $evento['idevento'];
		  	  				$dia = date("d/m", $data);
		  	  				$arquivo = $evento['arquivo'];

		  	  				echo "<tr>
		  	  						<td>$tipo - <a href='evento.php?idevento=$idevento'>$titulo - Dia: $dia</a>";

		  	  				if($emailconvite == $emailcookie){
		  	  					if($arquivo == 'nao'){
		  	  						echo " <a href='arquivo.php?id=$idevento' class='btn btn-primary'>Enviar Arquivo </a> ";
		  	  					}else{
		  	  						echo " <a href='arquivo/$arquivo' class='btn btn-danger'>Arquivo da palestra <span class='glyphicon glyphicon-file'></span></a> ";
		  	  					}
		  	  				}

		  	  				$baixar = mysqli_query($con, "select * from participar where idevento=$idevento and emailp = '$emailcookie'");
		  	  				if($a = mysqli_fetch_assoc($baixar)){
		  	  					if($arquivo != 'nao'){
		  	  						echo " <a href='arquivo/$arquivo' class='btn btn-danger btn-sm'>Arquivo da palestra <span class='glyphicon glyphicon-file'></span></a> ";
		  	  					}
		  	  				}


		  	  						echo "</td>
		  	  					  </tr>";
		  	  			}

		  	  		echo "</table>";
		  	  	}
		  	  ?>
		  	</div>
		  	
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Palestras anteriores</h3>
		  	</div>
		  	<div class="panel-body">
		  	  <?php 
		  	  	$atual = time();
		  	  	$ver = mysqli_query($con, "select e.*, c.* from evento e, convite c where e.datainicio < $atual and c.status = 'aceito' and e.id = c.idevento and c.email = '$email' order by datainicio desc");
		  	  	$pal = mysqli_num_rows($ver);
		  	  	if($pal==0){
		  	  		echo "<p>Sem palestras futuras no momento</p>";
		  	  	}else{
		  	  		echo "<table class='table'>
		  	  				<tr>
		  	  					<th>Evento</th>
		  	  				</tr>
		  	  			";
		  	  			while($evento = mysqli_fetch_array($ver)){
		  	  				$titulo = $evento['titulo'];
		  	  				$tipo = $evento['tipo'];
		  	  				$data = $evento['datainicio'];
		  	  				$idevento = $evento['idevento'];
		  	  				$dia = date("d/m", $data);
		  	  				echo "<tr>
		  	  						<td>";

		  	  				if($meu == 1){
		  	  					echo " <a href='certificadop.php?id=$idevento' class='btn btn-primary btn-xs'>Certificado</a> ";
		  	  				}
		  	  						echo "$tipo - $titulo - Dia: $dia";


		  	  						echo "</td>
		  	  					  </tr>";
		  	  			}

		  	  		echo "</table>";
		  	  	}
		  	  ?>
		  	</div>
		  	
		</div>
		<?php


			
			$votacao = mysqli_query($con, "select * from votacao where emailpa = '$email' and autorizado = 'sim' limit 1");
					while($depoimento = mysqli_fetch_array($votacao)){
						$comentario = $depoimento['comentario'];
						$idvotacao = $depoimento['id'];
						$idevento = $depoimento['idevento'];

						$eventoo = mysqli_query($con, "select * from evento where id = $idevento");
						while($ev = mysqli_fetch_array($eventoo)){
							$titulo = $ev['titulo'];
						}
						
							echo "<div class=\"panel panel-primary\">
								<div class=\"panel-heading\">
							    	<h3 class=\"panel-title\">Depoimento</h3>
							  	</div>
							  	<div class=\"panel-body\">
							  		<p>\"$comentario\"</p>
							  		<p>No evento $titulo</p>

							  		
							  	</div>
							  	</div>
							";
						


					}
				?>
	</section>
	
	
	</div>
<?php
	include "posterior.php";
?>