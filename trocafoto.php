<?php
	include "anterior.php";
?>
	<form method="post" action="upload.php" enctype="multipart/form-data">
	<h1>Atualizar Foto</h1>
	  <label>Foto</label>
	  <input type="file" name="arquivo" accept="image/jpg, image/jpeg" />
	  <p>Permitido apenas a extensão jpg</p>
	  <p></p>
	  <p></p>
	  <button type="submit" class="btn btn-primary">Enviar</button>
	</form>
<?php
	include "posterior.php";
?>

