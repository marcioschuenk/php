<?php
	include "anterior.php";
	include "modelo/banco.php";
	date_default_timezone_set('America/Sao_Paulo');
?>	
	
		    <?php
		    	$agora = time();
		    	$query = mysqli_query($con, "select e.*, c.*, u.*, u.id as idusu from evento e, convite c, usuario u  where e.datainicio > $agora and status = 'aceito' and e.id = c.idevento and u.email = c.email order by rand() limit 1");
		    	$t = mysqli_num_rows($query);
		    	if($t==0){
		    		echo "<p>Não tem evento no momento, crie seu evento em Acesso Restrito</p>";
		    	}else{
		    	while($ev = mysqli_fetch_array($query)){
		    		$titulo = $ev['titulo'];
		    		$vagas = $ev['vagas'];
		    		$tipo = $ev['tipo'];
		    		$datainicio = $ev['datainicio'];
		    		$email = $ev['email'];
		    		$endereco = $ev['endereco'];
		    		$descricao = $ev['descricao'];
		    		$inicio = date("d/m/Y - H:i", $datainicio);
		    		$idevento = $ev['idevento'];
		    		$investimento = $ev['investimento'];
		    		if($investimento > 0){
			    		$investimento = "R$ " . number_format($investimento, 2, ',','.');
			    	}else{
			    		$investimento = "Evento gratuito";
			    	}
		    		$megaevento = $ev['megaevento'];
		    		$nome = $ev['nome'];
		    		$id = $ev['idusu'];	
		    		$video = $ev['video'];

		    	}

		    ?>
	
		    <div class="jumbotron">
			  <h2><a href='evento.php?idevento=<?php echo $idevento; ?>'><?php echo "$titulo"; ?></a></h2>
			  <p><?php echo "$tipo - $descricao</p><p>Local: $endereco - Dia $inicio com <a href='perfilpalestrante.php?id=$id'> $nome</a><br />$investimento"; 
				if($video != 'nao'){
		    		echo " </p><p>Divulgação: <a href='$video' target='_blank'>Vídeo</a>";
		    	}
			  ?></p>
			  <p><a class="btn btn-primary btn-lg" href="participar.php?idevento=<?php echo $idevento; ?>" role="button">Inscreva-se</a>	<a class="btn btn-danger btn-lg pull-right" href="evento.php" role="button">Mais Eventos</a></p>
			</div>
	<?php
		}
	?>
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Palestrantes</h3>
	  </div>
	  <div class="panel-body">
	  <?php
	  		$query = mysqli_query($con, "select * from usuario where palestrante = 'sim' and foto = 'sim' order by rand()");
	  		$t = 0;
	  		while($dados = mysqli_fetch_array($query)){
	  			$nome = $dados['nome'];
	  			$email = $dados['email'];
	  			$cidade = $dados['cidade'];
	  			$id = $dados['id'];
	  				$pes = mysqli_query($con, "select * from votacao where emailpa = '$email'");
	  				$temvotos = mysqli_num_rows($pes);
	  				if($temvotos > 0){
		  				$vt = 0;
		  				$tot = 0;
		  				while($v = mysqli_fetch_array($pes)){
		  					$vt++;
		  					$tot = $tot + $v['palestrante'];
		  				}
		  				$geral = $tot/$vt;
		  				?>
		  				<div class="col-md-4 col-lg-4 col-sm-6 col-xm-12 wow <?php
		  				if($t == 1){
		  					echo "fadeInLeft";
		  				}
		  				if($t == 2){
		  					echo "fadeInLeft";
		  				}
		  				if($t == 0){
		  					echo "fadeInLeft";
		  				}
		  				$y = $t+1;
		  				?>" data-wow-duration="<?php echo $t; ?>s"  data-wow-delay="<?php echo $y; ?>s">	
				    		<div class="panel panel-default">
							  <div class="panel-heading">
							    <h3 class="panel-title"><?php echo $nome; ?></h3>
							  </div>
							  <div class="panel-body">
							  	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							   		<a href="perfilpalestrante.php?id=<?php echo $id; ?>">
							   		<img src="foto/<?php echo $id; ?>.jpg" class='img-responsive ftperfil2 centro' />
							   		</a>
							   	</div>
							   	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							   		<a href="perfilpalestrante.php?id=<?php echo $id; ?>">
							   		<p><?php echo "$nome"; ?></p>
							   		<p><?php echo "$cidade"; ?></p>
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
									?>
									</a>
							   	</div>

							  </div>
							</div>
						</div>

		  			<?php
	  				}		
	  			
	  			$t++;
	  			if($t == 3){
	  				break;
	  			}
	  			
			}


	  		
	  
	?>
			<a href="palestrantes.php" class="btn btn-primary">Ver mais</a>
	  </div>
	</div>



	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Próximos Eventos</h3>
	  </div>
	  <div class="panel-body">
	    	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			  <?php
			  	$atual =time();
			  	$query = mysqli_query($con, "select * from evento where datainicio > $atual order by datainicio limit 5");
				while($evento = mysqli_fetch_array($query)){
					$tipo = $evento['tipo'];
					$titulo = $evento['titulo'];
					$vagas = $evento['vagas'];
					$tema = $evento['tema'];
					$descricao = $evento['descricao'];
					$datainicio = $evento['datainicio'];
					$datainicio = date("d/m/Y H:i", $datainicio);
					$datatermino = $evento['datatermino'];
					$datatermino = date("d/m/Y H:i", $datatermino);
					$endereco = $evento['endereco'];
					$cidade = $evento['cidade'];
					$megaevento = $evento['megaevento'];
					$telefone = $evento['telefone'];
					$id = $evento['id'];
					$palestrante = $evento['palestrante'];
					if($megaevento == 'nao'){
						$query2 = mysqli_query($con, "select u.* from convite c, usuario u where c.idevento = '$id' and c.status = 'aceito' and u.email = c.email");
						while($pales = mysqli_fetch_array($query2)){
							$nome = $pales['nome'];
							$idpales = $pales['id'];
							$palestrante = "Palestrante: <a href='perfilpalestrante.php?id=$idpales'>$nome</a>";
						}
					}

			  ?>

			  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="heading<?php echo $id; ?>">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $id; ?>" aria-expanded="false" aria-controls="collapse<?php echo $id; ?>">
			          <?php echo "$tipo - $cidade"; ?>
			        </a>
			      </h4>
			    </div>
			    <div id="collapse<?php echo $id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $id; ?>">
			      <div class="panel-body">
			        <?php 
			  		echo "<p>Tema: $tema</p>";
			  		echo "<p>Descrição: $descricao</p>";
			  		echo "<p>$endereco - $datainicio até $datatermino</p>";
			  		if($palestrante == 'vazio' and $megaevento == 'nao'){
			  			echo "<p>A inscrição será aberta, após a confirmação de um palestrante.</p>";
			  		}
			  		if($megaevento == 'sim'){
			  			echo "<p><a href='participar.php?idevento=$id' class='btn btn-primary'>Inscreva-se neste evento</a></p>";
			  		}
			  		if($palestrante != 'vazio'){
			  			echo "<p>$palestrante</p>
			  					<p><a href='participar.php?idevento=$id' class='btn btn-primary'>Inscreva-se neste evento</a></p>";
			  		}

			  	?>
			      </div>
			    </div>
			  </div>
			<?php
			  	}
			  
			 ?>
			</div>
	  </div>
	</div>

			<script src="script/wow.js"></script>
            <script>
            	new WOW().init();
            </script>	
<?php
	include "posterior.php";

?>