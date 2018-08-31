<?php
	include "anterior.php";
?>
<h2>Cadastro</h2><hr />
<form method="post" action="cadastrar2.php">
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" required class="form-control" id="nome" name="nome" placeholder="Digite seu nome">
  </div>
  <div class="form-group">
    <p><label for="sexo">Sexo</label></p>
    <label class="radio-inline"><input type="radio" name="sexo" value="Masculino" checked>Masculino</label>
    <label class="radio-inline"><input type="radio" name="sexo" value="Feminino">Feminino</label>
  </div>
  <div class="form-group">
    <label for="cpf">CPF</label>
    <script src="controle/validarcpf.js"></script>
    <input onBlur="valida()" required type="number" name="cpf" class="form-control" id="cpf" placeholder="Digite seu CPF, somente números">
    <p id="status" class="status"></p>

  </div>
  <div class="form-group">
    <label for="cidade">Cidade</label>
    <input type="text" required class="form-control" id="cidade" name="cidade" placeholder="Digite sua cidade">
  </div>
  <div class="form-group">
    <label for="cidade">Estado</label>
    <input type="text" required class="form-control" id="estado" maxlength="2" name="estado" placeholder="Digite o seu Estado com dois digitos">
  </div>
  <div class="form-group">
    <label for="ddd">DDD</label>
    <input type="number" required class="form-control" id="ddd" name="ddd" placeholder="Digite seu DDD, somente números" maxlength="2">
  </div>
  <div class="form-group">
    <label for="telefone">Telefone</label>
    <input type="number" required class="form-control" id="telefone" name="telefone" placeholder="Digite seu Telefone, somente números" maxlength="2">
  </div>
  <div class="form-group">
    <label for="email">E-mail</label>
    <input type="email" required class="form-control" id="email" name="email" placeholder="Digite seu E-mail">
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a sua senha para acesso">
  </div>
  <div class="form-group">
    <label for="confsenha">Confirmar Senha</label>
    <input type="password" class="form-control" id="confsenha" name="confsenha" onblur="confirma()" placeholder="Confirme sua senha">
  </div>
  <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<?php
	include "posterior.php";
?>