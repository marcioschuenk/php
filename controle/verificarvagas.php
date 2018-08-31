<?php
	$verificar = mysqli_query($con, "select * from participar where idevento = '$idevento'");
	$inscritos = mysqli_num_rows($verificar);
?>