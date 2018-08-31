<?php
	include "controle/confereconexao.php";
	$email = $_COOKIE['email'];

	if(empty($_GET['id'])){
		header("Location: meuseventos.php");
	}
	$id = $_GET['id'];

	include "modelo/banco.php";
	$evento = mysqli_query($con, "select * from evento where id = $id");
	while($e = mysqli_fetch_array($evento)){
		$titulo = $e['titulo'];
		$tipo = $e['tipo'];
	}
	$parti = mysqli_query($con, "select * from participar where idevento = $id");
	$inscritos = mysqli_num_rows($parti);

	$partic = mysqli_query($con, "select p.*, u.* from participar p, usuario u where p.idevento = $id and p.emailp = u.email and p.presente = 1 and u.sexo = 'Masculino'");
	$homens = mysqli_num_rows($partic);

	$partic = mysqli_query($con, "select p.*, u.* from participar p, usuario u where p.idevento = $id and p.emailp = u.email and p.presente = 1 and u.sexo = 'Feminino'");
	$mulheres = mysqli_num_rows($partic);
	
	$presentes = $homens + $mulheres;



	include "anterior.php";
	echo "<h1>$tipo - $titulo</h1>";
?>
	<table  class="table table-striped">
	<tr class="success">
		<th>Informação</th>
		<th>Total</th>
	</tr>
	<tr>
		<td>Inscritos</td>
		<td><?php echo $inscritos; ?></td>
	</tr>
	<tr>
		<td>Presentes</td>
		<td><?php echo $presentes; ?></td>
	</tr>
	<tr>
		<td>Homens</td>
		<td><?php echo $homens; ?></td>
	</tr>
	<tr>
		<td>Mulheres</td>
		<td><?php echo $mulheres; ?></td>
	</tr>
	
	<tr class="success">
		<th>Estado</th>
		<th>Total</th>
	</tr>

	<?php
		$porestado = mysqli_query($con, "select p.*, u.*, count(u.estado) as est from participar p, usuario u where p.emailp = u.email and p.idevento = $id and p.presente = 1 group by u.estado");

		while($est = mysqli_fetch_array($porestado)){
			$testado = $est['est'];
			$estado = $est['estado'];

			echo "	<tr>
						<th>$estado</th>
						<th>$testado</th>
					</tr>";
		}

	?>
	<tr class="success">
		<th>Cidade</th>
		<th>Total</th>
	</tr>

	<?php
		$porestado = mysqli_query($con, "select p.*, u.*, count(u.cidade) as est from participar p, usuario u where p.emailp = u.email and p.idevento = $id and p.presente = 1 group by u.cidade order by u.estado");

		while($est = mysqli_fetch_array($porestado)){
			$testado = $est['est'];
			$estado = $est['cidade'];

			echo "	<tr>
						<th>$estado</th>
						<th>$testado</th>
					</tr>";
		}

	?>
	</table>
	<h2>Detalhe dos participantes</h2>
	<?php
	$usuario = mysqli_query($con, "select u.*, p.* from usuario u, participar p where p.emailp = u.email and p.idevento = $id order by p.presente desc, nome");
	while($u = mysqli_fetch_array($usuario)){
		$nome = $u['nome'];
		$cidade = $u['cidade'];
		$estado = $u['estado'];
		$email = $u['email'];
		$ddd = $u['ddd'];
		$telefone = $u['telefone'];
		$presente = $u['presente'];
		if($presente == 0){
			$pre = "Não";
		}else{
			$pre = "Sim";
		}

		echo "<p>Nome: $nome</p>";
		echo "<p>Cidade: $cidade - $estado</p>";
		echo "<p>E-mail: $email</p>";
		echo "<p>Telefone: ($ddd) $telefone</p>";
		echo "<p>Presente: $pre</p>";
		echo "<hr />";
	}

	?>
