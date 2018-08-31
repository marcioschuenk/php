<?php

	setcookie("nome", "", time()-1);
	setcookie("email", "", time()-1);

	header("Location:index.php");
?>