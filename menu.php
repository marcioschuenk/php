<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Menu</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Eventos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <!-- Aqui terá o banco de dados-->
            <li><a href="evento.php?id=Congresso">Congressos</a></li>
            <li><a href="evento.php?id=Curso">Cursos</a></li>
            <li><a href="evento.php?id=Feira">Feiras</a></li>
            <li><a href="evento.php?id=Palestra">Palestras</a></li>
            <li><a href="evento.php?id=Simpósio">Simpósios</a></li>
            <li><a href="evento.php?id=WorkShop">WorkShop</a></li>
            <li><a href="evento.php">Todos os eventos</a></li>
          </ul>
          </li>
      <li><a href="palestrantes.php">Palestrantes</a></li>           
      
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        
        <?php
          if(empty($_COOKIE['nome'])){
        ?>
        <li><a href="#" data-toggle="modal" data-target="#myModal">Acesso Restrito</a></li>
        <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body">
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
                  </form>
                    
                    
                    
                </div>
                <div class="modal-footer">
                      <a href="cadastrar.php" class="btn btn-danger">Cadastre-se Aqui</a>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div>
        <?php
        }else{ echo "<li><a href='perfil.php'>Perfil</a></li><li><a href='sair.php'>Sair</a></li>"; }
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>