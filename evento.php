<?php
	include "anterior.php";
	include "modelo/banco.php";
	date_default_timezone_set('America/Sao_Paulo');
	$atual = time();
	if(isset($_GET['id'])){
		$tipo = $_GET['id'];
		$query = mysqli_query($con, "select * from evento where tipo = '$tipo' and datainicio > $atual order by datainicio");
	}else{
		if(isset($_GET['idevento'])){
			$idevento = $_GET['idevento'];
			$query = mysqli_query($con, "select * from evento where id = '$idevento' and datainicio > $atual order by datainicio");
		}else{
			if(isset($_POST['pesquisa'])){
				$pesquisa = $_POST['pesquisa'];
				$query = mysqli_query($con, "select * from evento where (titulo like '%$pesquisa%' or tipo like '%$pesquisa%' or tema like '%$pesquisa%' or descricao like '%$pesquisa%' or cidade like '%$pesquisa%' or endereco like '%$pesquisa%') and datainicio > $atual order by datainicio");
			}else{
				$query = mysqli_query($con, "select * from evento where datainicio > $atual order by datainicio");
			}
		}
	}
	?>
	<form method="post" action="evento.php">
        <label for="searchBar">Procurar:</label>
        <div class="input-group">
            <input type="text" class="form-control" id="searchBar" placeholder="Digite alguma informação sobre o evento" name="pesquisa" />
            <span class="input-group-btn">
                <button type="submit" class="btn btn-info" value="Procurar">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
     </form><p></p>

	<?php
	$registros = mysqli_num_rows($query);
	if($registros == 0){
		echo "<p>Não há eventos para exibir, <a href='evento.php'>Clique aqui</a> para ver todos.</p>";
	}else{


		while($evento = mysqli_fetch_array($query)){
			$tipo = $evento['tipo'];
			$titulo = $evento['titulo'];
			$vagas = $evento['vagas'];
			$ideve = $evento['id'];
			$vr = mysqli_query($con, "select * from participar where idevento = $ideve");
			$vagasusadas = mysqli_num_rows($vr);
			$vagasrestantes = $vagas - $vagasusadas;
			$tema = $evento['tema'];
			$descricao = $evento['descricao'];
			$datainicio = $evento['datainicio'];
			$datainicio = date("d/m/Y H:i", $datainicio);
			$datatermino = $evento['datatermino'];
			$datatermino = date("d/m/Y H:i", $datatermino);
			$endereco = $evento['endereco'];
			$cidade = $evento['cidade'];
			$video = $evento['video'];
			$investimento = $evento['investimento'];
			if($investimento == 0){
				$investimento = "Gratuito";
			}else{
				$investimento = number_format($investimento, 2, ',','.');
				$investimento = "R$ $investimento";
			}
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
			<div class="panel panel-primary">
				<div class="panel-heading">
			    	<h3 class="panel-title"><?php echo "$tipo - $titulo"; ?></h3>
			  	</div>
			  	<div class="panel-body">
			  	<?php 
			  		echo "<p>Tema: $tema</p>";
			  		echo "<p>Descrição: $descricao</p>";
			  		echo "<p>Data: $datainicio até $datatermino</p>";
			  		if($palestrante == 'vazio' and $megaevento == 'nao'){
			  			echo "<p>A inscrição será aberta, após a confirmação de um palestrante.</p>";
			  		}
			  		
			  		if($palestrante != 'vazio'){
			  			echo "<p>$palestrante</p>";
			  		}
			  		echo "<hr /><p>Endereço: $endereco - $cidade</p>";
			  		echo "<p>Investimento: $investimento</p>";
			  		echo "<p>Vagas: $vagasrestantes</p><hr />";
			  		if($video != 'nao'){
			  			
    					$video = str_replace("watch?v=", "embed/", $video);
					    



				  		echo "<iframe width=\"100%\" height=\"300\" src=\"$video\" frameborder=\"0\" allowfullscreen></iframe><hr />";
				  	}
			  		if($palestrante != 'vazio'){
			  					echo "<p><a href='participar.php?idevento=$id' class='btn btn-primary'>Inscreva-se neste evento</a>"; 

			  					if(empty($_GET['idevento'])){
			  						echo " <a href='evento.php?idevento=$id' class='btn btn-info'>+ Info</a></p>";
			  					}
			  		}
			  		if($megaevento == 'sim'){
			  			echo "<p><a href='participar.php?idevento=$id' class='btn btn-primary'>Inscreva-se neste evento</a> <a href='evento.php?idevento=$id' class='btn btn-info'>+ Info</a></p>";
			  		}
			  		
			  	?>
			  	</div>
			 </div>
<?php
			}
	}
?>