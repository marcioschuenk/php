<?php
		if(empty($_COOKIE['email'])){
			header("Location:perfil.php");
		}else{
			$email = $_COOKIE['email'];
		}

		include "modelo/banco.php";
		
		if(empty($_POST['curriculo'])){
			$usuario = mysqli_query($con, "select * from usuario where email = '$email'");
			if($u = mysqli_fetch_assoc($usuario)){
				$curriculo = $u['curriculo'];
			}
		}else{
			$curriculo = $_POST['curriculo'];
			mysqli_query($con, "update usuario set curriculo = '$curriculo' where email = '$email'");
			header("Location: perfil.php");
		}
		include "anterior.php";
?>
<form method="post">
	<div class="form-group">
      <label for="curriculo">Fale Sobre você</label>
      <textarea required class="form-control" name="curriculo" id="curriculo" placeholder="Coloque aqui, suas informações educacionais e profissionais"><?php echo $curriculo; ?></textarea>
    </div>
     <button type="submit" class="btn btn-primary pull-right">Enviar</button>

</form>
<?php
	include "posterior.php";
?>