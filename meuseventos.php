<?php 


	date_default_timezone_set('America/Sao_Paulo');

	include "modelo/banco.php";
	include "controle/confereconexao.php";
	$email = $_COOKIE['email'];

	include "anterior.php";

	
	echo "<table class='table table-condensed table-striped'>";
	echo "	<tr>
				<th><p>Título</p></th>
				<th><p>Dia</p></th>
				<th><p>Vagas</p></th>
				<th><p>Convite</p></th>
				<th><p>Evento</p></th>
			</tr>
		 ";
	$atual = time();
	
	$query = mysqli_query($con, "select * from evento where organizador = '$email' and $atual < datainicio order by datainicio");
	$registros = mysqli_num_rows($query);
	if($registros > 0){

	
		 while($evento = mysqli_fetch_array($query)){
			$idusuario = 0;
		 	$id = $evento['id'];
		 	$video = $evento['video'];
		 	$arquivo = $evento['arquivo'];
		 	$tipo = $evento['tipo'];
		 	$titulo = $evento['titulo'];
		 	$inicio = $evento['datainicio'];
		 	$endereco = $evento['endereco'];
		 	$dia = $inicio;
		 	$dia = date("d/n", $dia);
		 	$inicio = date("d/n/y H:i", $inicio);
		 	$termino = $evento['datatermino'];
		 	$termino = date("d/n/y H:i", $termino);
		 	$vagas = $evento['vagas'];
		 	$participantes = mysqli_query($con, "select * from participar where idevento = $id");
		 	$tot = mysqli_num_rows($participantes);
		 	$vagas = $vagas - $tot;
		 	$megaevento = $evento['megaevento'];
		 	if($megaevento == 'sim'){
		 		$emailp = "-";
		 		$status = "aceito";
		 		$nome = "-";
		 	}else{
		 	$query2 = mysqli_query($con, "select * from convite where idevento = '$id'");
		 	$nome = "Sem palestrante";
		 	$status = "pendente";
		 	while($evento = mysqli_fetch_array($query2)){
		 		$emailp = $evento['email'];
		 		$status = $evento['status'];
		 		// echo "$emailp - $status";
			 	$query3 = mysqli_query($con, "select * from usuario where email = '$emailp'");
			 	while($usu = mysqli_fetch_array($query3)){
			 		$nome = $usu['nome'];
			 		$idusuario = $usu['id'];
			 	}
		 	}
		 	}
		 		if($megaevento == 'sim'){
		 			echo "<tr class='active'>";
		 		}
		 		if($status == 'aceito'){
		 			echo "<tr class='active'>";
		 		}
		 		if($status == 'recusado'){
					echo "<tr class='danger'>";		 			
		 		}
		 		if($status == 'pendente'){
					echo "<tr class='warning'>";		 			
		 		}
		 	echo "
		 				<td><p>$titulo</p></td>
						<td><p>$dia</p></td>
						<td><p> $vagas <span class='glyphicon glyphicon-zoom-in' aria-hidden='true' data-toggle='modal' data-target='#myModal$id'></span> </p>";
						?>
							<div class="modal fade" id="myModal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel"><?php echo "$titulo";?></h4>
							      </div>
							      <div class="modal-body">
							        <?php
							        	include "verparticipantes.php";
							        ?>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							      </div>
							    </div>
							  </div>
							</div>




<?php
						echo "</td>
						<td><p><a href='perfilpalestrante.php?id=$idusuario'>$nome - $status </a>";

						if($megaevento == 'nao'){
							echo "<a class='btn btn-primary btn-xs' href='convidar.php?id=$id'> <span class='glyphicon glyphicon-pencil'></span></a> ";

						}
						echo "</p></td>
						<td><p>";
						
			
			echo "<span class='glyphicon glyphicon-plus' aria-hidden='true' data-toggle='modal' data-target='#myModall$id'></span> <span class='glyphicon glyphicon-trash' aria-hidden='true' data-toggle='modal' data-target='#myModalex$id'></span> <a href='editarevento.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a> <a href='email.php?id=$id'><span class='glyphicon glyphicon-envelope'></span></a></p></td>
		 			</tr>

		 		 ";?>

		 		 <div class="modal fade" id="myModall<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel"><?php echo "$titulo";?></h4>
							      </div>
							      <div class="modal-body">
							        <?php
							        	echo "<h2>$tipo - $titulo</h2>";
							        	echo "<p>Data: $inicio</p>";
							        	echo "<p>Local: $endereco</p>";
							        	echo "<p>Inscritos: $n</p>";
							        	echo "<p>Vídeo: $video. </p>";
							        	echo "<p>Arquivo: $arquivo.";
							        	if($arquivo =='nao'){
							        		echo " Deseja<a href='arquivo.php?id=$id'> Enviar Arquivo?</a>";
							        	}
							        	echo "</p>";
							        	
							        ?>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							      </div>
							    </div>
							  </div>
							</div>

					<!-- Excluir -->
							<div class="modal fade" id="myModalex<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel"><?php echo "$titulo";?></h4>
							      </div>
							      <div class="modal-body">
							        <?php
							      	if($n < 1){
							      	?>
							      		<p>Tem Certeza que deseja Cancelar o seu evento?</p>
							      	<?php
							      }else{
							      	?>
							      		<p>Existem pessoas inscritas no evento, não é possível excluir a palestra nestas condições.</p>
							      	<?php
							      }
							      ?>
							      </div>
							      <div class="modal-footer">
							      	<?php
							      	if($n < 1){
							      	?>
								        <a class="btn btn-danger" href="excluirevento.php?id=<?php echo $id; ?>">Sim</a>
								        <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
								        <?php
							      	}else{
							      		?>
							      			<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							      		<?php

							      	}
							      	?>
							      </div>
							    </div>
							  </div>
							</div>							


		 		 <?php
		 }
	}else{
		echo "<tr> <th colspan=5>Nenhum evento previsto.</th></tr>";
	}
	echo "</table>";
	echo "<p><a href=\"novoevento.php\" class=\"btn btn-danger\"> Criar Evento</a></p>";
	echo "<h2>Eventos passados</h2>";
	echo "<table class='table table-condensed table-striped'>";
	echo "	<tr>
				<th><p>Título</p></th>
				<th><p>Data</p></th>
				<th><p>Vagas</p></th>
				<th><p>Avaliação</p></th>
			</tr>
		 ";
	$atual = time();
	
	$query = mysqli_query($con, "select * from evento where organizador = '$email' and $atual > datainicio order by datainicio");
	$registros = mysqli_num_rows($query);
	if($registros > 0){

	
		 while($evento = mysqli_fetch_array($query)){
			$idusuario = 0;
		 	$id = $evento['id'];
		 	$tipo = $evento['tipo'];
		 	$titulo = $evento['titulo'];
		 	$inicio = $evento['datainicio'];
		 	$dia = $inicio;
		 	$dia = date("d/n", $dia);
		 	$inicio = date("d/n/Y H:i", $inicio);
		 	$termino = $evento['datatermino'];
		 	$termino = date("d/n/y H:i", $termino);
		 	$vagas = $evento['vagas'];
		 	$endereco = $evento['endereco'];
		 	$megaevento = $evento['megaevento'];
		 	if($megaevento == 'sim'){
		 		$emailp = "-";
		 		$status = "aceito";
		 		$nome = "-";
		 	}else{
		 	$query2 = mysqli_query($con, "select * from convite where idevento = '$id'");
		 	while($evento = mysqli_fetch_array($query2)){
		 		$emailp = $evento['email'];
		 		$status = $evento['status'];
		 		// echo "$emailp - $status";
			 	$query3 = mysqli_query($con, "select * from usuario where email = '$emailp'");
			 	while($usu = mysqli_fetch_array($query3)){
			 		$nome = $usu['nome'];
			 		$idusuario = $usu['id'];
			 	}
		 	}
		 	}
		 		
		 	echo "<tr>
		 				<td><p>$titulo</p></td>
						<td><p>$dia</p></td>
						<td><p>$vagas</p></td>
						<td><p>";
						if($megaevento == 'nao'){
							echo "";

						}
			$vota = mysqli_query($con, "select avg(estrutura) as est, avg(palestrante) as pal, avg(organizacao) as org from votacao where idevento = '$id'");
			$totalvotos = 1;
			if($votac = mysqli_fetch_assoc($vota)){
				$est = $votac['est'];
				$est = number_format($est, 1,',','.');
				$org = $votac['org'];
				$org = number_format($org, 1,',','.');
				$pal = $votac['pal'];
				$pal = number_format($pal, 1,',','.');
				if($votac['est']== null){
					$totalvotos = 0;
				}
			}
			echo "<span class='glyphicon glyphicon-user btn btn-primary btn-xs' aria-hidden='true' data-toggle='modal' data-target='#myModal$id'></span> <span class='glyphicon glyphicon-plus btn btn-primary btn-xs' aria-hidden='true' data-toggle='modal' data-target='#myModall$id'></span> <a href='grafico.php?id=$id'><span class=\"glyphicon glyphicon-stats btn btn-xs btn-primary \" aria-hidden=\"true\"></span></a>";  ?>
			<div class="modal fade" id="myModal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel"><?php echo "$titulo";?></h4>
							      </div>
							      <div class="modal-body">
							        <?php
							        	include "verparticipantes.php";
							        ?>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							      </div>
							    </div>
							  </div>
							</div>
							<div class="modal fade" id="myModall<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title" id="myModalLabel"><?php echo "$titulo";?></h4>
							      </div>
							      <div class="modal-body">
							        <?php
							        	echo "<h2>$tipo - $titulo</h2>";
							        	echo "<p>Data: $inicio</p>";
							        	echo "<p>Local: $endereco</p>";
							        	echo "<p>Inscritos: $n</p>";
							        	echo "<h3>Votação</h3>";
							        	if($totalvotos>0){
								        	echo "<p>Estrutura: $est</p>";
								        	echo "<p>Organização: $org</p>";
								        	echo "<p>Palestrante: $pal</p>";
								        }else{
								        	echo "<p>Não há votos no momento</p>";
								        }
								        echo "<hr /><a href='grafico.php?id=$id' class='btn btn-primary btn-sm'><span class=\"glyphicon glyphicon-stats\" aria-hidden=\"true\"></span> Estatistcas</a>";
							        ?>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
							      </div>
							    </div>
							  </div>
							</div>

			<?php
			echo "
			</td>
		 			</tr>
		 		 ";
		 }
	}else{
		echo "<tr> <th colspan=5>Nenhum evento passado.</th></tr>";
	}




?>