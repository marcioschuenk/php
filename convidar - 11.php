<?php
	session_start();

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$_SESSION['id'] = $id;
		header("Location:convidar.php");
	}else{
		if(isset($_SESSION['id'])){
			$id = $_SESSION['id'];
		}else{
			if(isset($_POST['id'])){
				$id = $_POST['id'];
			}else{
				header("Location:meuseventos.php");
			}
		}
	}
?>
	<?php
		include "modelo/banco.php";
		$query = mysqli_query($con, "select * from evento where id=$id");
		if($evento = mysqli_fetch_assoc($query)){
			$nome = $evento['titulo'];
		}
		include "anterior.php";
		echo "<p>Convite para o evento: $nome</p>";
	?>
	<form method="post" action="convidar.php">
	    <div class="form-group">

	      <label for="pesquisa">Digite nome ou e-mail do palestrante</label>
	      <p><input name="pesquisa" class="form-control" id="pesquisa" />
	      	<input type="hidden" value="<?php echo "$id"; ?>" name="id" /></p>
	      <p><button class="btn btn-primary" type="submit">Pesquisar</button></p>
	    </div>
	</form>

	<?php 
		if(isset($_POST['id'])){
				$id = $_POST['id'];
				$pesquisa = $_POST['pesquisa'];
				$query = mysqli_query($con, "select * from usuario where (nome like '%$pesquisa%' or email like '%$pesquisa%') and palestrante = 'sim'");

				while($nomes = mysqli_fetch_array($query)){
					$nome = $nomes['nome'];
					$email = $nomes['email'];
					$idu = $nomes['id'];
					$foto = $nomes['foto'];
					echo "<div class='panel panel-primary'>
					  <div class='panel-heading'>
					    <p class='panel-title'>$nome</p>
					  </div>
					  <div class='panel-body'>
					  <div class='col-xs-12 col-sm-6 col-md-4 col-lg-4'>";
						if($foto == 'nao'){
							echo "<img class='img-responsive img-circle ftperfil' src='foto/vazio.png' />";
						}else{
							echo "<img class='img-responsive ftperfil' src='foto/$idu.jpg' />";
						}
					  echo "
					  </div>
					  <div class='col-xs-12 col-sm-6 col-md-8 col-lg-8'>
					  		<p>Nome: $nome</p>
					  		<p>E-mail: $email</p>
					  		<a class='btn btn-primary' href='enviaconvite.php?id=$id&email=$email'>Convidar</a>
					  </div>
					  </div>
					</div>";
				}
		}
	?>



