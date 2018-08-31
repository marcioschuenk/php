<?php
	date_default_timezone_set('America/Sao_Paulo');
	session_start();
	include "modelo/banco.php";

	if((empty($_GET['idevento'])) and (empty($_SESSION['idevento']))){
		header("Location:index.php");
	}
	if(isset($_SESSION['idevento'])){
		$idevento = $_SESSION['idevento'];
	}
	if(isset($_GET['idevento'])){
		$idevento = $_GET['idevento'];
		$_SESSION['idevento'] = $idevento;
		header("Location:participar.php");
	}
	if(isset($_GET['participar'])){
		$email = $_COOKIE['email'];
		$participar = $_GET['participar'];
		$_SESSION['idevento'] = null;
		if($participar == 1){
			$verificar = mysqli_query($con, "select * from participar where idevento = '$idevento' and emailp = '$email'");
			$total = mysqli_num_rows($verificar);
			if($total >= 1){
				header("Location: perfil.php");
			}else{
				mysqli_query($con, "insert into participar(emailp, idevento) values ('$email', '$idevento')");
			}
			
		}
		header("Location:perfil.php");
	}

	include "anterior.php";
	if(empty($_COOKIE['email'])){
		
?>
	<form method="post" action="login.php">
    	<div class="form-group">
    	<p> Para participar, é necessário ser cadastrado, faça o Login, ou cadastre-se em nosso site</p>
    		<label for="exampleInputEmail1">Email</label>
    		<input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Digite Seu E-mail">
	    </div>
    	<div class="form-group">
    		<label for="exampleInputPassword1">Senha</label>
    		<input type="password" class="form-control" name="senha" id="exampleInputPassword1" placeholder="Digite aqui a sua senha">
    	</div>
    	<button type="submit" class="btn btn-primary">Entrar</button>
        <a href="cadastrar.php" class="btn btn-danger pull-right">Cadastre-se Aqui</a>
    </form>

    
    
<?php
	}else{
		$atual = time();
		$query = mysqli_query($con, "select * from evento where id = $idevento");
			 while($evento = mysqli_fetch_array($query)){
			 	$tipo = $evento['tipo'];
			 	$titulo = $evento['titulo'];
			 	$iniciod = $evento['datainicio'];
			 	$inicio = date("d/m/Y", $iniciod);
			 	$hora = date("H:i", $iniciod);
			 	$vagas = $evento['vagas'];
			 	$megaevento = $evento['megaevento'];

			 	include "controle/verificarvagas.php";
			 	
			 	
			 	if($megaevento == 'sim'){
			 		$nome = "-";
			 	}else{
				 	$query2 = mysqli_query($con, "select * from convite where idevento = '$idevento'");
				 	while($evento = mysqli_fetch_array($query2)){
				 		$emailp = $evento['email'];
				 		
				 		$query3 = mysqli_query($con, "select * from usuario where email = '$emailp'");
					 	while($usu = mysqli_fetch_array($query3)){
					 		$nome = $usu['nome'];
					 		$idusuario = $usu['id'];
					 	}
				 	}
			 	}
			 }

	if($inscritos < $vagas){
		$email = $_COOKIE['email'];
		$verificar = mysqli_query($con, "select * from participar where idevento = '$idevento' and emailp = '$email'");
			$total = mysqli_num_rows($verificar);
			if($total >= 1){
				echo "<p>Sua presença já está confirmada neste evento, você será redirecionado para seu perfil.</p>";
				$_SESSION['idevento'] = null;
				header("Refresh:5, perfil.php");
			}else{
?>
	<p> Deseja realmente confirmar presença no evento <?php echo "$titulo - no dia $inicio às $hora?"; ?></p>
	<p>
		<a href="participar.php?participar=1" class="btn btn-primary">Sim</a>
		<a href="participar.php?participar=0" class="btn btn-danger">Não</a>
	</p>
<?php
			}
	}else{
		echo "<p> Este evento já está com número de vagas preenchido, você será redirecionado para seu perfil</p>";
		$_SESSION['idevento'] = null;
		header("Refresh:5, perfil.php");
	}
	}
?>