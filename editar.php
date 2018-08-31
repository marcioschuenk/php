<?php

	include "modelo/banco.php";
	
	if(isset($_POST['cidade'])){
		//$nome = htmlspecialchars($_POST['nome']);
		//$cpf = htmlspecialchars($_POST['cpf']);
		$cidade = htmlspecialchars($_POST['cidade']);
		$ddd = htmlspecialchars($_POST['ddd']);
		$telefone = htmlspecialchars($_POST['telefone']);
		$email = htmlspecialchars($_POST['email']);
		$antigoemail = $_COOKIE['email'];
		
		if(empty($_POST['senha'])){
			$query = "update usuario set cidade = '$cidade', ddd = '$ddd', telefone = '$telefone', email = '$email' where email = '$antigoemail'";
	
			$nome = $_COOKIE['nome'];

			setcookie("nome", $nome, time()+60*60*2);
			setcookie("email", $email, time()+60*60*2);

		}else{
			$senha = htmlspecialchars($_POST['senha']);
			$senha = md5($senha);
			$query = "update usuario set cidade = '$cidade', senha = '$senha', ddd = '$ddd', telefone = '$telefone', email = '$email' where email = '$antigoemail'";
	
			$nome = $_COOKIE['nome'];

			setcookie("nome", $nome, time()+60*60*2);
			setcookie("email", $email, time()+60*60*2);
		}
		mysqli_query($con, $query);
		header("Location: perfil.php");
	}


	include "controle/confereconexao.php";
	$email = $_COOKIE['email'];
	$query = mysqli_query($con, "select * from usuario where email = '$email'");

	if($dados = mysqli_fetch_assoc($query)){
		$nome = $dados['nome'];  
		$foto = $dados['foto'];  
		$id = $dados['id'];  
		$ddd = $dados['ddd'];
		$telefone = $dados['telefone'];
		$palestrante = $dados['palestrante'];  
		$senha = $dados['senha'];
		$cidade = $dados['cidade'];
	}
	include "anterior.php";
?>
		<div class="panel panel-primary">
			<div class="panel-heading">
		    	<h3 class="panel-title">Editar Perfil</h3>
		  	</div>
		  	<div class="panel-body">
				<form method="post">
					<div class="form-group">
					    <label for="cidade">Cidade</label>
					    <input type="text" value="<?php echo $cidade ?>" required class="form-control" id="cidade" name="cidade" placeholder="Digite sua cidade">
					  </div>
					  <div class="form-group">
					    <label for="ddd">DDD</label>
					    <input type="number" value="<?php echo $ddd ?>" required class="form-control" id="ddd" name="ddd" placeholder="Digite seu DDD, somente números" maxlength="2">
					  </div>
					  <div class="form-group">
					    <label for="telefone">Telefone</label>
					    <input type="number" value="<?php echo $telefone ?>" required class="form-control" id="telefone" name="telefone" placeholder="Digite seu Telefone, somente números" maxlength="9">
					  </div>
					  <div class="form-group">
					    <label for="email">E-mail</label>
					    <input type="email" value="<?php echo $email ?>" required class="form-control" id="email" name="email" placeholder="Digite seu E-mail">
					  </div>
					  <div class="form-group">
					    <label for="senha">Nova Senha</label>
					    <script src="controle/validarcpf.js"></script>
					    <p> Se não quiser alterar a senha, basta deixar em branco.</p>
					    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a sua senha para acesso">
					  </div>
					  <div class="form-group">
					    <label for="confsenha">Confirmar Nova Senha</label>
					    <input type="password" class="form-control" id="confsenha" name="confsenha" onblur="confirma()" placeholder="Confirme sua senha">
					  </div>
					  <div class="form-group">
					  		<button type="submit" class="btn btn-primary">Alterar</button>
					  </div>
					  
				</form>
			</div>
		</div>
