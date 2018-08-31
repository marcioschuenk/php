<?php
	include "anterior.php";
?>
<h1>Organização de Eventos</h1>
<form method="post" action="login.php">
    <div class="form-group">
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
	include "posterior.php";
?>