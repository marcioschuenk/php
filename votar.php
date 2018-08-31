<?php
	if(empty($_GET['id'])){
		header("Location:perfil.php");
	}
	include "controle/confereconexao.php";
	include "modelo/banco.php";
	$id = $_GET['id'];
	$email = $_COOKIE['email'];
	$query = mysqli_query($con, "select * from evento where id = $id");
	while($evento = mysqli_fetch_array($query)){
		$titulo = $evento['titulo'];
		$megaevento = $evento['megaevento'];
	}
	$query = mysqli_query($con, "select * from convite where idevento = $id");
	while($convite = mysqli_fetch_array($query)){
		$emailpa = $convite['email'];
	}
	$query = mysqli_query($con, "select * from usuario where email = '$emailpa'");
	while($convite = mysqli_fetch_array($query)){
		$nome = $convite['nome'];
	}

	include "anterior.php";
?>
	<h1>Avalie o Evento <?php echo "$titulo"; ?></h1>
	<form method="post" action="votar2.php">
		<input type="hidden" name="idevento" value="<?php echo "$id"; ?>" />
		<input type="hidden" name="email" value="<?php echo "$email"; ?>" />
		<input type="hidden" name="emailpa" value="<?php echo "$emailpa"; ?>" />
		<div class="radio">
			<p><label>Estrutura do evento - Limpeza, clima, cadeiras, banheiro, etc.</label></p>
	    
		    <p><label for="estotimo"><input type="radio"  id="estotimo" name="estrutura" value="10" checked>Ótimo</label></p>
		    
		    <p><label for="estbom"><input type="radio" id="estbom" name="estrutura" value="8">Bom</label></p>
		   
		    <p><label for="estregular"><input type="radio" id="estregular" name="estrutura" value="6">Regular</label></p>
		    
		    <p><label for="estruim"><input type="radio" id="estruim" name="estrutura" value="3">Ruim</label></p>
		    
		    <p><label for="estpessimo"><input type="radio" id="estpessimo" name="estrutura" value="0">Péssimo</label></p>
		</div>
		<hr />
		<div class="radio">
			<p><label>Organização do evento - Horário, informações, acessibilidade, etc.</label></p>
		    
		    <p><label for="orgotimo"><input type="radio"  id="orgotimo" name="organizacao" value="10" checked>Ótimo</label></p>
		    
		    <p><label for="orgbom"><input type="radio" id="orgbom" name="organizacao" value="8">Bom</label></p>
		   
		    <p><label for="orgregular"><input type="radio" id="orgregular" name="organizacao" value="6">Regular</label></p>
		    
		    <p><label for="orgruim"><input type="radio" id="orgruim" name="organizacao" value="3">Ruim</label></p>
		    
		    <p><label for="orgpessimo"><input type="radio" id="orgpessimo" name="organizacao" value="0">Péssimo</label></p>
		</div>
		<hr />
		<?php 
			if($megaevento=='nao'){
		?>
		<div class="radio">
			<p><label>Palestrante <?php echo "$nome"; ?></label></p>
		    
		    <p><label for="palotimo"><input type="radio"  id="palotimo" name="palestrante" value="10" checked>Ótimo</label></p>
		    
		    <p><label for="palbom"><input type="radio" id="palbom" name="palestrante" value="8">Bom</label></p>
		   
		    <p><label for="palregular"><input type="radio" id="palregular" name="palestrante" value="6">Regular</label></p>
		    
		    <p><label for="palruim"><input type="radio" id="palruim" name="palestrante" value="3">Ruim</label></p>
		    
		    <p><label for="palpessimo"><input type="radio" id="palpessimo" name="palestrante" value="0">Péssimo</label></p>
		</div><hr />
		<div class="form-group">
		    <label for="comentario">Comentários sobre o palestrante <?php echo "$nome"; ?>´</label>
		    <textarea class="form-control" id="comentario" name="comentario" placeholder="O que você achou do palestrante?"></textarea>
		</div>
		<?php
			}else{
				echo "<input type='hidden' name='palestrante' value='0' />
					<input type='hidden' name='comentario' value='-' />";
			}
			?>
		<button type="submit" class="btn btn-primary">Avaliar</button>

	</form>
<?php
	include "posterior.php";
?>