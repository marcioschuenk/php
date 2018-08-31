<?php
	include "modelo/banco.php";
	include "anterior.php";
	if(empty($_POST['pesquisa'])){
		header("Location:palestrantes.php");
	}
?>
	<div class="form-group">
	<form method="post" action="palestrante.php">
        <label for="searchBar">Procurar:</label>
        <div class="input-group"><!--Estava faltando essa div-->
            <input type="text" class="form-control" id="searchBar" placeholder="Digite alguma informação sobre o palestrante" name="pesquisa" />
            <span class="input-group-btn"><!--Estava faltando esse span-->
                <button type="submit" class="btn btn-info" value="Procurar">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
     </form><p></p>
   				<a href="palestrantes.php" class="btn btn-info">
                    Retirar Todos os filtros de pesquisa
                </a>
    </div>
<?php
	
	$pesquisa = $_POST['pesquisa'];
	$busca = "SELECT * from usuario where (nome like '%$pesquisa%' or email like '%$pesquisa%' or cidade like '%$pesquisa%') and palestrante = 'sim'";
	$total_reg = "5"; // número de registros por página
	if(empty($_GET['pagina'])){
		$pagina=1;	
	}else{
		$pagina=$_GET['pagina'];
	}
	  if (!$pagina) {
	 	 $pc = "1";
	  } else {
	 	 $pc = $pagina;
	  }
 	$inicio = $pc - 1;
  	$inicio = $inicio * $total_reg;

  		$limite = mysqli_query($con, "$busca LIMIT $inicio,$total_reg");
		$todos = mysqli_query($con, "$busca");
	 
		$tr = mysqli_num_rows($todos); // verifica o número total de registros
		$tp = $tr / $total_reg; // verifica o número total de páginas
	 
	  // vamos criar a visualização
		while ($dados = mysqli_fetch_array($limite)) {
			
			$nome = $dados['nome'];
			$idpalestrante = $dados['id'];
			$cidade = $dados['cidade'];
			$emailpalestrante = $dados['email'];
			$foto = $dados['foto'];

			?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo "$nome"; ?></h3>
				</div>
				<div class="panel-body">
					<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
			   			<a href="perfilpalestrante.php?id=<?php echo $idpalestrante; ?>">
						<?php
							if($foto == 'nao'){
								echo "<img class='img-responsive img-circle ftperfil' src='foto/vazio.png' />";
							}else{
						?>
			   					<img src="foto/<?php echo $idpalestrante; ?>.jpg" class='img-responsive ftperfil2 centro' />
			   			<?php
			   				}
			   			?>
			   			</a>
			   		</div>
			   		<div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">
				   		<a href="perfilpalestrante.php?id=<?php echo $idpalestrante; ?>">
				   		<p><?php echo "$nome"; ?></p>
				   		<p><?php echo "$cidade"; ?></p>
				   		<p><?php echo "$emailpalestrante"; ?></p>
				   		
						</a>
				   	</div>
				 </div>
			</div>

		
			<?php

		}
	 
		  // agora vamos criar os botões "Anterior e próximo"
		  $anterior = $pc -1;
		  $proximo = $pc +1;
		if ($pc>1) {
			echo " <a href='?pagina=$anterior'><- Anterior </a> ";
		}
		
		if ($pc<$tp) {
			  echo " <a href='?pagina=$proximo'> Próxima -></a>";
	  	}
 ?>