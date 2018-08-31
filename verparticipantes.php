<?php  
	$part = mysqli_query($con, "select * from participar where idevento = $id");
	$este = mysqli_num_rows($part);
	$n = 0;
	if($este == 0){
		echo "<p>Não há inscritos.</p>";
	}else{
?>
<table class="table">
<tr>
	<th>N</th>
	<th>Nome - E-mail: </th>
	<th>Presente?</th>
</tr>
<?php
	
	while($p = mysqli_fetch_array($part)){
		$n++;
		$presente = $p['presente'];
		if($presente==0){
			$presenca = 'Não';
		}else{
			$presenca = 'Sim';
		}
		$emailpa = $p['emailp'];
		$npart = mysqli_query($con, "select * from usuario where email = '$emailpa'");
		while($pa = mysqli_fetch_array($npart)){
			$nomepa = $pa['nome'];
		}
		echo "<tr>
			<td>$n</td>
			<td>$nomepa - $emailpa</td>
			<td> $presenca</td>
			</tr>
				";
	}
?>	
</table>
<?php
	}
?>